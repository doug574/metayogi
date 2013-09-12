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
 * Deletes a records from a collection
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class DeleteAction extends BaseAction implements ActionInterface
{
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $collection = $this->router->get('controller.instances');
        $this->dbh->remove($collection, $this->router->get('params.id'));
        $this->mediator->dispatch(Kernel::ACTION_POST, $this->event);
        
        return array();
    }
}
