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
 * Class for an html hidden element
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class HiddenElement extends BaseElement implements WidgetInterface
{
    /**
    * {@inheritdoc}
    */
    public function build($properties)
    {
        parent::build($properties);
    }
    
    /**
     * {@inheritdoc}
     */
    public function addElement()
    {
        $html .= "<input type='hidden'";
        $html .= $this->addAttributes();
        $html .= " value='" . $this->value . "' ";
        $html .= " />\n";
        $html .= "<br />";
        
        return $html;
    }
}
