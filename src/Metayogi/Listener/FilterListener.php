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
 * Looks for get parameters and store them in the route which ListAction
 * uses to filter a collection
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class FilterListener
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
        $request = $event->getRequest();
        $router = $event->getRouter();
        if ($request->query->has('submitButton')) {
            $request->query->remove('submitButton');
            $keys = $request->query->keys();
            foreach ($keys as $key) {
                $val = $request->query->get($key);
                if (empty($val)) {
                    $request->query->remove($key);
                }
            }
            $query = $request->query->all();
            $router->set('query', $query);
        }
        
    }
}
