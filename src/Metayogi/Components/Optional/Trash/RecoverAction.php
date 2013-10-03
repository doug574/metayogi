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
class RecoverAction extends BaseAction implements ActionInterface
{
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $instance = $this->router->getInstance();
        $trashID = (string) $instance['_id'];

        /* Pull instance out of Trash */
#        $instance = $this->dbh->load(TrashPlugin::TRASH_COLLECTION, $trashID);

        /* Move to original collection */
        $this->dbh->insert($instance['collection'], $instance['doc']);

        /* Delete from trash */
        $this->dbh->remove(TrashPlugin::TRASH_COLLECTION, $trashID);

        /* Redirect to previous page */
        $this->mediator->dispatch(Kernel::ACTION_POST, $this->event);
    }
}
