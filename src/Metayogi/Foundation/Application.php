<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Foundation;
 
/**
 * Class for generating a response based on a client request
 *
 * @package Metayogi;
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class Application extends \Pimple
{
    const VERSION = '0.01-DEV';

    /**
     * Create the Metayogi application instance.
     *
     * @param Symfony\HttpFoundation\Request  $request
     *
     * @return void
     */
    public function __construct(Symfony\HttpFoundation\Request $request = null)
    {
        parent::__construct();

        $this['request'] = ($request == null) ? $this->createRequest($request) : $request;
        $this['router'] = null;
        $this['logger'] = null;
        $this['dbh'] = null;
    }
 
    /**
     * Handles the given request and delivers the response.
     *
     * @return void
     */
    public function run()
    {
        $response = new \Symfony\Component\HttpFoundation\Response();
/* $this['router']->dispatch($this->prepareRequest($request)); */
        $response->send();
    }

    /**
     * Create the request for the application.
     *
     * @param  \Symfony\Component\HttpFoundation\Request  $request
     *
     * @return \Symfony\Component\HttpFoundation\Request
     */
    protected function createRequest(\Symfony\Component\HttpFoundation\Request $request = null)
    {
        /* Command line request */
        if (PHP_SAPI == 'cli') {
            return \Symfony\Component\HttpFoundation\Request::create(
                '/',
                'GET',
                array()
            );
        }

        /* Web request */
        return \Symfony\Component\HttpFoundation\Request::createFromGlobals();
    }

}
