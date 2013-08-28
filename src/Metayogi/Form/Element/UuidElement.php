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
class UuidElement extends BaseElement implements WidgetInterface
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
		if (empty($this->value)) {
			$this->value = $this->dbh->createID();
		}
        $this->attributes['readonly'] = 'readonly';
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
		$html .= " />";

        return $html;
    }
}