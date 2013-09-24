<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Components\Core\ViewWizard;

use Metayogi\Event\ApplicationEvent;

/**
 * desc
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
    }

}
