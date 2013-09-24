<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Components\Core\Cache;

use Metayogi\Foundation\Kernel;
use Metayogi\Action\BaseAction;
use Metayogi\Action\ActionInterface;

/**
 * Shows a list of the cached collections 
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class BrowseAction extends BaseAction implements ActionInterface
{
    /**
     * {@inhertdoc}
     */
    public function run()
    {
        $results = array();
        $caches = array_keys($this->registry->get('cache'));
        foreach ($caches as $cache) {
            $size = $this->dbh->count($cache);
            $cache_size = $this->dbh->count($cache . ".cache");
            $results[] = array('name' => $cache, 'size' => $size, 'cache' => $cache_size);
        }
        $this->data->setStore($results);
        
        $this->mediator->dispatch(Kernel::ACTION_POST, $this->event);
    }
}
