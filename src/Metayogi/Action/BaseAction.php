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
    * Event object
    * @var Metayogi\Event\ApplicationEvent
    */
    protected $event;
        
    /**
     * Constructor inherited by all actions. Makes global objects available to the action.
     *
     * @access public
     * @param Metayogi\Database\DatabaseInterface               $dbh
     * @param Metayogi\Routing\Router                           $router
     * @param Metayogi\Foundation\Registry                      $registry
     * @param Metayogi\Viewer\ViewerInterface                   $viewer
     * @param Symfony\Component\HttpFoundation\Request          $request
     * @param Symfony\Component\EventDispatcher\EventDispatcher $mediator
     * @param Metayogi\Event\ApplicationEvent                   $event
     * @return void
     */
    public function __construct (
        DatabaseInterface $dbh,
        Router $router,
        Registry $registry,
        ViewerInterface $viewer,
        Request $request,
        EventDispatcher $mediator,
        ApplicationEvent $event
    ) {
        $this->dbh = $dbh;
        $this->router = $router;
        $this->registry = $registry;
        $this->viewer = $viewer;
        $this->request = $request;
        $this->mediator = $mediator;
        $this->event = $event;
    }

    /**
     * Completes the action, dispataches the next event, and returns data result
     *
     * @abstract
     * @access public
     * @return array data result 
     */
    abstract public function run();
}
