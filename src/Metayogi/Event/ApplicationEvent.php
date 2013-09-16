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
    protected $session;
    protected $registry;
    protected $viewer;
    protected $form;
    
    /**
    * Data service
    * @var Metayogi\Foundation\DataArray
    */
    protected $data;
    
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
        $this->session = $app['session'];
        $this->registry = $app['registry'];
        $this->viewer = $app['viewer'];
        $this->data = $app['data'];
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

    /**
    * Makes session service available
    *
    * @access public
    * @return Symfony\Component\HttpFoundation\Session\Session
    */
    public function getSession()
    {
        return $this->session;
    }

    /**
    * Makes session service available
    *
    * @access public
    * @return Metayogi\Foundation\Registry
    */
    public function getRegistry()
    {
        return $this->registry;
    }

    public function setViewer($viewer)
    {
        $this->viewer = $viewer;
    }
    
    public function getViewer()
    {
        return $this->viewer;
    }
    
    public function setForm($form)
    {
        $this->form = $form;
    }
    
    public function getForm()
    {
        return $this->form;
    }
        
    public function getData()
    {
        return $this->data;
    }
}
