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

    /**
     * Create the Metayogi application instance.
     *
     * @param  \Metayogi\Http\Request  $request
     * @return void
     */
    public function __construct(Request $request = null)
    {
        $this['request'] = $this->createRequest($request);
    }
 
    /**
     * Handles the given request and delivers the response.
     *
     * @return void
     */
    public function run()
    {
        $response = $this->dispatch($this['request']);
        $response->send();
    }

    /**
     * Create the request for the application.
     *
     * @param  \Metayogi\Http\Request  $request
     * @return \Metayogi\Http\Request
     */
    protected function createRequest(Request $request = null)
    {
        return $request ?: static::onRequest('createFromGlobals');
    }

}
