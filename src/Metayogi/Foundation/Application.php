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
use Metayogi\Exception\Handler;
use Metayogi\Foundation\Registry;
 
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

        $this['request'] = ($request == null) ? $this->createRequest($request) : $request;
        $this['router'] = $this->share(function ($this) {
            return new $this['config']['router']['class']();
        });;
        $this['logger'] = $this->share(function ($this) {
            return new $config['logger']['class']();
        });;
        $this['dbh'] = $this->share(function ($this) {
            return new $this['config']['database']['class']($this['config']['database']);
        });;
        $this['mediator'] = $this->share(function ($this) {
            $mediator = $this['config']['mediator']['class'];
            return new $mediator();
        });;
        $this['controller'] = $this->share(function ($this) {
            return new $this['config']['controller']['class']();
        });;
        $this['exception_handler'] = $this->share(function ($this) {
            return new Handler($this['config']['settings']['debug']);
        });        

        $this['registry'] = $this->share(function ($this) {
            return new Registry();
        });
        $this['registry']->setStore($this->loadRegistry());

        $this['router']->setDbh($this['dbh']);
        $this['router']->setErrorHandler($this['exception_handler']);
        $this['router']->setRegistry($this['registry']);

        $this['controller']->setMediator($this['mediator']);
        $this['controller']->setRouter($this['router']);
        
    }
 
    /**
     * Handles the given request and delivers the response.
     *
     * @return void
     */
    public function run()
    {
        $this['mediator']->dispatch('app.boot');

        $response = $this->handle($this['request']);
#        $response->send();

        $this['mediator']->dispatch('app.terminate');
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
        
        $response = $this['controller']->handle($request);
        $this['mediator']->dispatch('response.post');
        
        return $response;
    }

    protected function loadRegistry()
    {
        try {
            return $this['dbh']->load(Kernel::REGISTRY_COLLECTION, Kernel::REGISTRY_ROOT);
        } catch (\Exception $e) {
        }
        
    }
}
