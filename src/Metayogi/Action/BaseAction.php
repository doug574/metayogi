<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Action;

use Metayogi\Database\DatabaseInterface;
use Metayogi\Routing\Router;
use Metayogi\Foundation\Registry;
use Metayogi\Viewer\ViewerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Metayogi\Event\ApplicationEvent;
 
/**
 * Base class for actions. Expect child classes will use this constructor and will not override or extend it.
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 * @abstract
 */
abstract class BaseAction
{
    /**
    * Database service
    * @var Metayogi\Database\DatabaseInterface
    */
    protected $dbh;

    /*
    * Search service
    * @var object
    */
    protected $search;
    
    /**
    * Router service
    * @var Metayogi\Routing\Router
    */
    protected $router;
    
    /**
    * Registry service
    * @var Metayogi\Foundation\Registry
    */
    protected $registry;
    
    /**
    * Viewer service
    * @var Metayogi\Viewer\ViewerInterface
    */
    protected $viewer;
    
    /**
    * Http request service
    * @var Symfony\Component\HttpFoundation\Request
    */
    protected $request;
    
    /**
    * Event dispatcher service
    * @var Symfony\Component\EventDispatcher\EventDispatcher
    */
    protected $mediator;
    
    /**
    * Data service
    * @var Metayogi\Foundation\DataArray
    */
    protected $data;
    
    /**
    * Event object
    * @var Metayogi\Event\ApplicationEvent
    */
    protected $event;
        
    /**
     * Constructor inherited by all actions. Makes global objects available to the action.
     *
     * @access public
     * @param object $app
     * @param object $event
     * @return void
     */
    public function __construct ($app, $event)
    {
        $this->dbh = $app['dbh'];
        $this->search = $app['search'];
        $this->router = $app['router'];
        $this->registry = $app['registry'];
        $this->viewer = $app['viewer'];
        $this->request = $app['request'];
        $this->mediator = $app['mediator'];
        $this->data = $app['data'];
        $this->event = $event;
    }

    /**
     * Completes the action, sets data result, dispataches the next event
     *
     * @access public
     * @return void
     */
    public function run()
    {
    }
}
