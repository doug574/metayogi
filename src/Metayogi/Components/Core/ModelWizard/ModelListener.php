<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Components\Core\ModelWizard;

use Metayogi\Event\ApplicationEvent;
use Metayogi\Foundation\Kernel;
use Metayogi\Components\Core\ModelWizard\ModelWizard;

/**
 * Handles events from model/class actions
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class ModelListener
{
    /**
    * Dispatched after model created 
    *
    * @access public
    * @param Metayogi\Event\ApplicationEvent $event
    * @return void
    */
    public function onCreate(ApplicationEvent $event)
    {
        $wizard = new ModelWizard($event->getDbh(), $event->getRouter(), $event->getRegistry(), $event->getData());
        $wizard->create();
    }
    
    /**
    * Dispatched after model updated 
    *
    * @access public
    * @param Metayogi\Event\ApplicationEvent $event
    * @return void
    */
    public function onUpdate(ApplicationEvent $event)
    {
        $wizard = new ModelWizard($event->getDbh(), $event->getRouter(), $event->getRegistry(), $event->getData());
        $wizard->update();
    }
    
    /**
    * Dispatched after model deleted 
    *
    * @access public
    * @param Metayogi\Event\ApplicationEvent $event
    * @return void
    */
    public function onDelete(ApplicationEvent $event)
    {
        $wizard = new ModelWizard($event->getDbh(), $event->getRouter(), $event->getRegistry(), $event->getData());
        $wizard->delete();
    }
}
