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
class ButtonElement extends BaseElement implements WidgetInterface
{

    /**
    * desc
    *
    * @access public
    * @return void
    */
    public function build($properties)
    {
		parent::build($properties);
	}

    /**
     * Short description for function
     * 
     * @return string  
     * @access public
     */
    public function render()
    {
		$html = "<button ";
		$html .= $this->addAttributes();
		$html .= ">" . $this->value . "</button>";
		
		return $html;
    }

}