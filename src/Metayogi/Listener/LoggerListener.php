<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Listener;

use Metayogi\Event\ApplicationEvent;

/**
 * Handles log events
 *
 * @package Metayogi;
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class LoggerListener
{
    /**
    * Logging service
    * @var mixed
    */
    protected $logger;
    
    /**
    * Makes logger service available
    *
    * @access public
    * @return void
    */
    public function __construct($logger)
    {
        $this->logger = $logger;
    }

    /**
    * Generates log entry for a completed action
    *
    * @access public
    * @param Metayogi\Event\ApplicationEvent $event
    * @return void
    */
    public function onAction(ApplicationEvent $event)
    {
        $router = $event->getRouter();
        $action = $router->get('action');
        if ($action == '\\Metayogi\\Action\\EditAction' || $action == '\\Metayogi\\Action\\CreateAction' || $action == '\\Metayogi\\Action\\DeleteAction') {
            $collection = $router->get('controller.collection');
            $msg = $action . " on " . $collection;
            $this->logger->notice($msg);
            $event->getSession()->getFlashBag()->add('notice', $msg);
        }
    }
}
