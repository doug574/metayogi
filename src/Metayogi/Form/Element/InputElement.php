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
class InputElement extends BaseElement implements WidgetInterface
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
    public function render()
    {
        $html = "";
            $html .= "<input type='text'";
            $html .= $this->addAttributes();
            $html .= " value='" . htmlentities(stripslashes($value), ENT_QUOTES, 'UTF-8', false) . "' ";
            $html .= " />\n";
            $html .= "<br />";

        return $html;
    }
}
