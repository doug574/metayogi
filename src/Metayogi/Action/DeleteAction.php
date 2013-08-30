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
 *
 */
class DeleteAction extends BaseAction implements ActionInterface
{
    /**
     * Description
     *
     * @return void
     */
    public function run()
    {
        $collection = $this->router->getRoute('controller.instances');
        $this->dbh->remove($collection, $this->router->getRoute('instanceID'));
        $this->mediator->dispatch(Kernel::ACTION_POST, $this->event);
        
        return array();
    }

}