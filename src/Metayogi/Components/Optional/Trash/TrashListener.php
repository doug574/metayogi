<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Components\Optional\Trash;

use Metayogi\Event\ApplicationEvent;

/**
 * Handles redirect events
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class TrashListener
{
    /**
    * Generates redirect response for actions not needing display
    *
    * @access public
    * @param Metayogi\Event\ApplicationEvent $event
    * @return void
    */
    public function onDelete(ApplicationEvent $event)
    {
        $dbh = $event->getDbh();
        $router = $event->getRouter();
        #print_r($route);
        #exit;

        /* Label will just be first field (other then _id) value */
        $values = array_values($router->get('instance'));
        $label = $values[1];
        $collection = $router->get('controller.collection');

        /* Create a new Trash record */
        $newrecord = array(
                        '_id' => $router->get('params.id'),
                        'deletedate' => time(),
                        'label'=> $label,
                        'collection' => $collection,
                        'user' => 'anonymous', #$app->user->getUsername(),
                        'doc' => $router->get('instance'),
                        'rdf:type' => 'my:trash',
                    );

        /* Save to Trash collection */
        $dbh->insert(TrashPlugin::TRASH_COLLECTION, $newrecord);


    }
}
