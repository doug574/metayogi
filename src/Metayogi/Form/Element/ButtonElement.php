<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Form\Element;

use Metayogi\Form\BaseWidget;
use Metayogi\Form\WidgetInterface;

/**
 * Class for an html button element
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class ButtonElement extends BaseElement implements WidgetInterface
{
    /**
    * {@inheritdoc}
    */
    public function build($properties)
    {
        parent::build($properties);
        $this->classes[] = "btn btn-default";
    }

    /**
     * 
     */
    public function addElement()
    {
        $html = "<button ";
        $html .= $this->addAttributes();
        $html .= ">" . $this->value . "</button>";
        
        return $html;
    }
}
