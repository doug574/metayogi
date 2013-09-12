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
 * desc
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class TextAreaElement extends BaseElement implements WidgetInterface
{
    /**
    * desc
    *
    * @param array  $properties Desc
    *
    * @access public
    * @return void
    */
    public function build($properties)
    {
        parent::build($properties);
    }
    
    /**
     * Description
     *
     * @return string
     * @access public
     */
    public function addElement()
    {
        $html = "";
            $html .= "<textarea ";
            $html .= $this->addAttributes();
            $html .= " >\n";
            $html .= $this->value;
            $html .= "</textarea>";

        return $html;
    }
}
