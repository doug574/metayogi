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
 * Defines interface for our Action classes
 *
 * @package Metayogi;
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
interface ActionInterface
{
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
    public function __construct(
        DatabaseInterface $dbh,
        Router $router,
        Registry $registry,
        ViewerInterface $viewer,
        Request $request,
        EventDispatcher $mediator,
        ApplicationEvent $event
    );

    /**
     * Completes the action, dispataches the next event, and returns data result
     *
     * @return array data result 
     * @access public
     */
    public function run();
}
