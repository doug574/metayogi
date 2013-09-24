<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Components\Core\Controller;

use Metayogi\Event\ApplicationEvent;
use Metayogi\Foundation\Kernel;

/**
 * Handles events from model/class actions
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class ControllerListener
{
    /**
    * Dispatched after model updated 
    *
    * @access public
    * @param Metayogi\Event\ApplicationEvent $event
    * @return void
    */
    public function onUpdate(ApplicationEvent $event)
    {
        $wizard = new Behaviours($event->getDbh(), $event->getRouter(), $event->getRegistry(), $event->getData());
        $wizard->update();
    }    
}
