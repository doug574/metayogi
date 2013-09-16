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
 * Empties all cache collections
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class ResetAction extends BaseAction implements ActionInterface
{
    /**
     * {@inhertdoc}
     */
    public function run()
    {
        $caches = array_keys($this->registry->get('cache'));
        foreach ($caches as $cache) {
            $collection = $cache . ".cache";
            $this->dbh->truncate($collection);
        }
        $this->mediator->dispatch(Kernel::ACTION_POST, $this->event);

        return array();
    }
}
