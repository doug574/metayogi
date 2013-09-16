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
use Symfony\Component\HttpFoundation\Session\Session;
use Metayogi\Exception\Handler;
use Metayogi\Foundation\Registry;
use Metayogi\Foundation\Kernel;
use Metayogi\Foundation\DisplayHandler;
use Metayogi\Foundation\DataArray;
use Metayogi\Event\ApplicationEvent;
use Metayogi\Event\ExceptionEvent;
use Metayogi\Listener\LoggerListener;
use Metayogi\Listener\ExceptionListener;
use Metayogi\Listener\AuthorizeListener;
 
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
            return new DataArray();
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

        $this['search'] = $this->share(function ($this) {
            return new $this['config']['search']['class']($this['config']['search']);
        });
        
        $this['mediator'] = $this->share(function ($this) {
            $mediator = $this['config']['mediator']['class'];
            return new $mediator();
        });
        
        $this['response'] = $this->share(function ($this) {
            return new Response();
        });
        
        $this['registry'] = $this->share(function ($this) {
            return new Registry($this);
        });
        
        $this['session'] = $this->share(function($this) {
            return new Session();
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
        $this->handle($this['request']);
        $this['response']->send();
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
        $this['session']->start();
        $event = new ApplicationEvent($this);

        /* Kernel listeners */
        $log = new LoggerListener($this['logger']);
        $this['mediator']->addListener(Kernel::ACTION_POST, array($log, 'onAction'));
        $elistener = new ExceptionListener();
        $this['mediator']->addListener(Kernel::APPLICATION_EXCEPTION, array($elistener, 'onException'));
        $alistener = new AuthorizeListener();
        $this['mediator']->addListener(Kernel::VIEWER_INIT, array($alistener, 'onAuth'));
        

        /*
        * Catch any uncaught exceptions, handled with ExceptionListener
        * which generates an error response
        */
        try {
        
            $this['mediator']->dispatch(Kernel::APPLICATION_BOOT, $event);

            /*
            * Route
            */
            $this['router']->findRoute($request);
            $this['router']->build($request);

            /* 
            * Viewer
            */
            $this['mediator']->dispatch(Kernel::VIEWER_INIT, $event);
            $this['viewer'] = $this->share(function ($this) {
                $viewer = $this['router']->get('viewer');
                return new $viewer($this);
            });
            $this['viewer']->build();
            $event->setViewer($this['viewer']);
        
            /* 
            * Action 
            * Kernel::Action_POST and Kernel::ACTION_CANCEL dispatched in action class
            */
            $this->addListeners($event);
            $actionName = $this['router']->get('action');
            $action = new $actionName($this, $event);
            $this['mediator']->dispatch(Kernel::ACTION_PRE, $event);
            $action->run();
        
            /* 
            * Display 
            */
            $display = new DisplayHandler($this);
            $display->build();
            $this['viewer']->addContent($display);
        
            /* Response */
            $this['mediator']->dispatch(Kernel::VIEWER_INJECT, $event);        
            $content = $this['viewer']->render();
            $this['response']->setContent($content);
        
            $this['mediator']->dispatch(Kernel::APPLICATION_SHUTDOWN, $event);

        } catch (\Exception $e) {
            $eevent = new ExceptionEvent($e);
            $this['mediator']->dispatch(Kernel::APPLICATION_EXCEPTION, $eevent);
        }
    
        return $this['response'];
    }

    /**
    * Add event listeners from controller
    * 
    * @param Metayogi\Event\ApplicationEvent $event
    */
    protected function addListeners(ApplicationEvent $event)
    {
        if (! $this['router']->has('controller.listeners')) {
            return;
        }
    
        $listeners = $this['router']->get('controller.listeners');
        $action = $this['router']->get('action');
        if (substr($action, 0, 1) != '\\') {
            $action = '\\' . $action;
        }
        if (! empty ($listeners[$action])) {
            foreach ($listeners[$action] as $properties) {
                $eventName = $properties['event'];
                $listenerName = $properties['listener'];
                $method = empty($properties['method']) ? 'run' : $properties['method'];
                $priority = empty($properties['priority']) ? 0 : $properties['priority'];
                $listener = new $listenerName();
                $this['mediator']->addListener($eventName, array($listener, $method), $priority);
            }
        }
    }
}
