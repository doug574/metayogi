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
 * Edits a record in a collection
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class EditAction extends BaseAction implements ActionInterface
{
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $data = array();
        
        if ($this->request->request->has('submitButton')) {
            $data = $this->request->request->all();
            $form = new FormContainer($this->dbh, $this->router, $this->registry, $this->viewer, $data);
            $form->build($this->router->get('view.FormDisplay'));
            if ($form->isValid()) {
                $this->event->setForm($form);
                $this->mediator->dispatch(Kernel::FORM_VALID, $this->event);
                $data = $form->submit();
                $collection = $this->router->get('controller.instances');
                $this->dbh->update($collection, $data);
                $this->event->setData($data);
                $this->mediator->dispatch(Kernel::ACTION_POST, $this->event);
            }
        } elseif ($this->request->request->has('cancelButton')) {
            $this->mediator->dispatch(Kernel::ACTION_CANCEL, $this->event);
            exit;
        } else {
            $data = $this->router->getInstance();
        }
        
        return $data;
    }
}
