<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Components\Core\SearchWizard;

use Metayogi\Event\ApplicationEvent;

/**
 * Handles events from model/class actions
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class SearchFormListener
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
        $wizard = new SearchWizard($event->getDbh(), $event->getRouter(), $event->getRegistry(), $event->getData());
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
        $wizard = new SearchWizard($event->getDbh(), $event->getRouter(), $event->getRegistry(), $event->getData());
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
        $wizard = new SearchWizard($event->getDbh(), $event->getRouter(), $event->getRegistry(), $event->getData());
        $wizard->delete();
    }

}
