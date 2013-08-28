<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Foundation;
 
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Metayogi\Exception\Handler;
use Metayogi\Foundation\Registry;
use Metayogi\Event\ApplicationEvent;
use Metayogi\Event\ApplicationEvents;
 
/**
 * Class for generating a response based on a client request
 *
 * @package Metayogi;
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class Application extends \Pimple implements HttpKernelInterface
{
    const VERSION = '0.01-DEV';

    /**
     * Create the Metayogi application instance.
     *
     * @param array   $config
     * @param Request $request
     *
     * @return void
     */
    public function __construct($config, Request $request = null)
    {
        parent::__construct();

        $this['config'] = $config;
        $this['data'] = $this->share(function ($this) {
            return new \ArrayObject();
        });

        $this['request'] = ($request == null) ? $this->createRequest($request) : $request;

        $this['router'] = $this->share(function ($this) {
            return new $this['config']['router']['class']($this['dbh'], $this['registry']);
        });        
        
        $this['logger'] = $this->share(function ($this) {
            return new $this['config']['logger']['class']('Metayogi');
        });
        $this['logger']->pushHandler(new $this['config']['logger']['handler']($this['config']['logger']['file'], $this['config']['logger']['level']));
        
        $this['dbh'] = $this->share(function ($this) {
            return new $this['config']['database']['class']($this['config']['database']);
        });
        $this['mediator'] = $this->share(function ($this) {
            $mediator = $this['config']['mediator']['class'];
            return new $mediator();
        });
        $this['controller'] = $this->share(function ($this) {
            return new $this['config']['controller']['class']($this);
        });
        $this['exception_handler'] = $this->share(function ($this) {
            return new Handler($this, $this['config']['settings']['debug']);
        });
        $this['exception_handler']->register();

        
        $this['response'] = $this->share(function ($this) {
            return new Response();
        });
        
        $this['registry'] = $this->share(function ($this) {
            return new Registry($this);
        });
        
        $this['viewer'] = null;
    }
 
    /**
     * Handles the given request and delivers the response.
     *
     * @return void
     */
    public function run()
    {
        $event = new ApplicationEvent($this);
    
        $this['mediator']->dispatch(ApplicationEvents::APP_BOOT, $event);

        $this->handle($this['request']);
        $this['mediator']->dispatch('request.post', $event);
        $this['response']->send();

        $this['mediator']->dispatch(ApplicationEvents::APP_SHUTDOWN, $event);
    }

    /**
     * Create the request for the application.
     *
     * @param  Request  $request
     * @return Request
     */
    protected function createRequest(Request $request = null)
    {
        global $argv, $argc;

        /* Command line request */
        if (PHP_SAPI == 'cli') {
            return Request::create(
                $argv[1],
                'GET',
                array()
            );
        }

        /* Web request */
        return Request::createFromGlobals();
    }

    /**
     * {@inheritdoc}
     */
    public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true)
    {
        $event = new ApplicationEvent($this);

        /* Generic listeners */
        
        
        $this['mediator']->dispatch('route.pre', $event);
        $this['router']->findRoute($request);
        $this['mediator']->dispatch('route.post', $event);

        /* Layout */
        $this['viewer'] = $this->share(function ($this) {
            $viewer = $this['router']->getRoute('viewer');
            return new $viewer($this);
        });
        $this['viewer']->build($this);

        /* Controller listeners */
        $this['controller']->addListeners();
        
        /* Action */
        $actionName = $this['router']->getRoute('action');
        $action = new $actionName($this['dbh'], $this['router'], $this['registry'], $this['viewer']);

        $this['mediator']->dispatch('action.pre', $event);
        $data = $action->run();
        $this['data']->exchangeArray($data);
        $this['mediator']->dispatch('action.post', $event);
        
        /* Display */
        $displayName = $this['router']->getRoute('view.display');
        $display = new $displayName($this['dbh'], $this['router'], $this['registry'], $this['viewer'], $this['data']);
        $display->build();
        $this['viewer']->addContent($display);
        
        /* Generate response */
        $content = $this['viewer']->render();
        $this['response']->setContent($content);
        
        return $this['response'];
    }

}
