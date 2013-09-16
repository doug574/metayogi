<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Display;

use Metayogi\Form\Container\FormContainer;

/**
 * Generic record display class
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class FormDisplay extends BaseDisplay implements DisplayInterface
{
    /** desc */
    public $form;

    /**
     * Description
     *
     * @param object $app Description
     *
     * @return void
     * @access public
     */
    public function build()
    {
        $buttons = array (
            'widget' => '\\Metayogi\\Form\\Container\\HorizontalContainer',
            'elements' => array (
                'submitButton' => array (
                    'widget' => '\\Metayogi\\Form\\Element\\ButtonElement',
                    'type' => 'submit',
                    'class' => 'btn',
                    'value' => 'Save',
                ),
                'reloadButton' => array (
                    'widget' => '\\Metayogi\\Form\\Element\\ButtonElement',
                    'type' => 'submit',
                    'class' => 'btn hidden',
                    'value' => 'Reload',
                    'id' => 'reloadButton',
                ),
                'cancelButton' => array (
                    'widget' => '\\Metayogi\\Form\\Element\\ButtonElement',
                    'type' => 'submit',
                    'class' => 'btn',
                    'value' => 'Cancel',
                ),
            ),
        );
        $properties = $this->router->get('view.FormDisplay');
        if (! empty($properties['elementset'])) {
            $properties['elementset']['elements']['buttons'] = $buttons;
        } else {
            $properties['elements']['buttons'] = $buttons;
        }
        $properties['method'] = 'post';
        $properties['enctype'] = 'multipart/form-data';

        $this->form = new FormContainer($this->dbh, $this->router, $this->registry, $this->viewer, $this->data);
        $this->form->build($properties);
        
        if ($this->request->request->has('submitButton')) {
            $this->form->isValid();
        }

    }

    /**
     * Description
     *
     * @return string
     * @access public
     */
    public function render()
    {
        return $this->form->render();
    }
}
