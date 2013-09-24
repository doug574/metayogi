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
 * @package Html\Elements
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class UserElement extends BaseElement
{

    /**
    * desc
    *
    * @param object $app        desc
    * @param array  $properties Desc
    *
    * @access public
    * @return void
    */
    public function build($properties)
    {
		parent::build($properties);
		if (empty($this->value)) {
			/* $this->value = $app->user->getUsername(); */
            $this->value = 'anonymous';
		}
		$this->attributes['readonly'] = 'readonly';
	}

  /**
     * Generate html for this element
     * 
     * @return string Html string
     * @access public
     */
    public function addElement()
    {
        $html = "";
		$html .= "<input type='text'";
		$html .= $this->addAttributes();
		$html .= " />";

        return $html;
    }
}
