<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Event;

use Symfony\Component\EventDispatcher\Event;
use Metayogi\Foundation\Application;

/**
 * Desc
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class ApplicationEvent extends Event
{
    /**
    * Database service
    * @var Metayogi\Database\DatabaseInterface
    */
    protected $dbh;

    /**
    * Router service
    * @var Metayogi\Routing\Router
    */
    protected $router;

    /**
    * Http request service
    * @var Symfony\Component\HttpFoundation\Request
    */
    protected $request;

    /**
     * Makes global services available via DI container. And makes them
     * available to event listeners.
     *
     * @param Metayogi\Foundation\Application $app
     * @access public
     * @return void
     */
    public function __construct($app)
    {
        $this->dbh = $app['dbh'];
        $this->router = $app['router'];
        $this->request = $app['request'];
    }

    /**
    * Makes database service available
    *
    * @access public
    * @return Metayogi\Database\DatabaseInterface
    */
    public function getDbh()
    {
        return $this->dbh;
    }
        
    /**
    * Makes router service available
    *
    * @access public
    * @return Metayogi\Routing\Router
    */
    public function getRouter()
    {
        return $this->router;
    }
    
    /**
    * Makes request service available
    *
    * @access public
    * @return Symfony\Component\HttpFoundation\Request
    */
    public function getRequest()
    {
        return $this->request;
    }
}
