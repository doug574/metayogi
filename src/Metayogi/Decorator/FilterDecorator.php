<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Decorator;

use Metayogi\Form\Container\FormContainer;

/**
 * Description
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class FilterDecorator extends BaseDecorator implements DecoratorInterface
{
    /** desc */
    protected $form;

    /**
     * Description
     *
     * @return void
     * @access public
     */
    public function build()
    {
        $properties = $this->router->getRoute('view.FilterDecorator');
        $properties['elements']['submitButton'] = array (
            'widget' => 'myButtonElement',
            'type' => 'submit',
            'class' => 'btn',
            'value' => 'Filter',
            );
        $properties['method'] = 'get';

        $this->form = new myFormContainer($this->dbh, $this->router, $this->registry, $this->viewer, $this->data);
        $this->form->build($properties);
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
