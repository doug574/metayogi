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
 * Empties a cache (truncates a cache collection)
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class FlushAction extends BaseAction implements ActionInterface
{
    /**
     * {@inhertdoc}
     */
    public function run()
    {
        $cache = $this->request->query->get('cache') . ".cache";
        $this->dbh->truncate($cache);
        $this->mediator->dispatch(Kernel::ACTION_POST, $this->event);

        return array();
    }
}
