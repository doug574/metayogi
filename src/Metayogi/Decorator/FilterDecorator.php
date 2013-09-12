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
        $properties = $this->router->get('view.FilterDecorator');
        $properties['elements']['submitButton'] = array (
            'widget' => '\\Metayogi\\Form\\Element\\ButtonElement',
            'type' => 'submit',
            'class' => 'btn',
            'value' => 'Filter',
            );
        $properties['method'] = 'get';

        /*
        * Inject values from prev query in form properties
        */
        if ($this->router->has('query')) {
            foreach ($this->router->get('query') as $key => $val) {
                $properties['elements'][$key]['default'] = $val;
            }
        }

        /*
        * Create filter form
        */
        $this->form = new FormContainer($this->dbh, $this->router, $this->registry, $this->viewer, $this->data);
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
        $html = "<div class='panel panel-default'>\n";
        $html .= "<div class='panel-body'>\n";
        $html .= $this->form->render();
        $html .= "</div></div>\n";
        
        return $html;
    }
}
