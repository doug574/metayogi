<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Action;

use Metayogi\Foundation\Kernel;
 
/**
 * Lists records in a collection
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class ListAction extends BaseAction implements ActionInterface
{
    /**
     * {@inhertdoc}
     */
    public function run()
    {
        $attrs = array();
        if ($this->router->has('params')) {
            $attrs = $this->router->get('params');
        }
        $query = array();
        if ($this->router->has('query')) {
            $query = $this->router->get('query');
        }
        $collection = $this->router->get('controller.instances');
        $results = $this->dbh->query($collection, $query, $attrs);
        $this->data->setStore($results);
        
        $this->mediator->dispatch(Kernel::ACTION_POST, $this->event);
    }
}
