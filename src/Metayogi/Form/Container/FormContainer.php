<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Form\Container;

use Metayogi\Form\WidgetInterface;

/**
 * desc
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class FormContainer extends BaseContainer implements WidgetInterface
{
    /** desc */
    protected $layout;
    
    /**
    * {@inheritdoc}
    */
    public function build($properties)
    {
        parent::build($properties);
        $this->role = 'form';
        $this->layout = "";
        if (isset($properties['layout'])) {
            $this->layout = $properties['layout'];
            $this->classes[] = $properties['layout'];
        }
    }

    /**
    * {@inheritdoc}
    */
    public function render()
    {
        $html = "";
        if (! empty($this->errors)) {
            $html .= "<div class='alert alert-danger'>\n<ul>\n";
            foreach ($this->errors as $err) {
                $html .= "<li>" . $err . "</li>\n";
            }
            $html .= "</ul></div>\n";
        }

        $html .= "<div><form ";
        $html .= $this->addAttributes() . ">\n";
        $html .= $this->renderElements();
        $html .= "</form></div>\n";

        return $html;
    }
}
