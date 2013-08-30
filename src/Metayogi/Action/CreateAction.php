<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Action;

use Metayogi\Form\Container\FormContainer;
use Metayogi\Foundation\Kernel;
 
/**
 * Lists records in a collection
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class CreateAction extends BaseAction implements ActionInterface
{
    /**
     * Description
     *
     * @param object $app Description
     *
     * @return void
     */
    public function run()
    {
        if ($this->request->request->has('submitButton')) {
            $data = $this->request->request->all();
            $form = new FormContainer($this->dbh, $this->router, $this->registry, $this->viewer, $data);
            $form->build($this->router->getRoute('view.FormDisplay'));
            if ($form->isValid()) {
                $collection = $this->router->getRoute('controller.instances');
                $this->dbh->insert($collection, $data);
                $this->mediator->dispatch(Kernel::ACTION_POST, $this->event);
            }
        } else if ($this->request->request->has('cancelButton')) {
            $this->mediator->dispatch(Kernel::ACTION_CANCEL, $this->event);
            exit;
        } else if ($this->request->request->has('rdf:type')) {
            $data = $this->request->request->all();
        } else {
            $data = array();
        }

        return $data;
    }
}