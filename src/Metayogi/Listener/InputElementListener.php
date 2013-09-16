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
 * Handles add and del buttons for InputElement
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class InputElementListener
{
    /**
    * Add or del value from data object
    *
    * @access public
    * @param Metayogi\Event\ApplicationEvent $event
    * @return void
    */
    public function run(ApplicationEvent $event)
    {
        $data = $event->getData();
        
        $posts = $event->getRequest()->request->keys();
        foreach ($posts as $postvar) {
            if (substr($postvar, 0, 10) == 'addButton_') {
                $key = substr($postvar, 10);
                $data->push($key, '');
            }
            if (substr($postvar, 0, 10) == 'delButton_') {
                $key = substr($postvar, 10);
                $new = $data->get($key);
                array_pop($new);
                $data->set($key, $new);
            }
        }
    }
}
