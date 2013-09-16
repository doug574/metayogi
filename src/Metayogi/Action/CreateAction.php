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
 *  Create new data object
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class CreateAction extends BaseAction implements ActionInterface
{
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        if ($this->request->request->has('submitButton')) {
            $this->data->setStore($this->request->request->all());
            $form = new FormContainer($this->dbh, $this->router, $this->registry, $this->viewer, $this->data);
            $form->build($this->router->get('view.FormDisplay'));
            if ($form->isValid()) {
                $this->event->setForm($form);
                $this->mediator->dispatch(Kernel::FORM_VALID, $this->event);
                $data = $form->submit();
                $collection = $this->router->get('controller.instances');
                $this->dbh->insert($collection, $data);
                #$this->event->setData($data);
                $this->data->setStore($data);
                $this->mediator->dispatch(Kernel::ACTION_POST, $this->event);
            }
        } elseif ($this->request->request->has('cancelButton')) {
            $this->mediator->dispatch(Kernel::ACTION_CANCEL, $this->event);
            exit;
        } elseif ($this->request->request->has('rdf:type')) {
            $data = $this->request->request->all();
            #$this->event->setData($data);
            $this->data->setStore($data);
            $this->mediator->dispatch(Kernel::FORM_RELOAD, $this->event);
        } else {
            $data = array();
        }

        return;
    }
}
