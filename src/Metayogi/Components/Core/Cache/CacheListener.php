<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Components\Core\Cache;

use Metayogi\Event\ApplicationEvent;

/**
 * desc
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class CacheListener
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
        $dbh = $event->getDbh();
        $router = $event->getRouter();
        $registry = $event->getRegistry();

        /* If cached collection delete cached instance */
        $collection = $router->get('controller.instances');
        $cache = $registry->get('cache');
        if (empty($cache[$collection])) {
            return;
        }

        $collection = $collection . ".cache";
        $dbh->remove($collection, $router->get('params.id'));

    }

}
