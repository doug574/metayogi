<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Components\Optional\Trash;
 
use Metayogi\Action\BaseAction;
use Metayogi\Action\ActionInterface;
use Metayogi\Foundation\Kernel;

/**
 * Empties the trash (truncates trash collection)
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class EmptyAction extends BaseAction implements ActionInterface
{
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $this->dbh->truncate(TrashPlugin::TRASH_COLLECTION);
        $this->mediator->dispatch(Kernel::ACTION_POST, $this->event);
        
        return;        
    }
}
