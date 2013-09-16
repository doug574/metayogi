<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Components\Core\ComponentManager;

use Metayogi\Event\ApplicationEvent;
use Metayogi\Foundation\Kernel;
use \Metayogi\Components\Core\ComponentManager\ComponentManagerPlugin;

/**
 * 
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class ComponentListener
{
    /**
    * Generates redirect response for actions not needing display
    *
    * @access public
    * @param Metayogi\Event\ApplicationEvent $event
    * @return void
    */
    public function run(ApplicationEvent $event)
    {
        $dbh = $event->getDbh();
        $registry = $event->getRegistry();
        
        ComponentManagerPlugin::register($dbh, $registry);
    }
}
