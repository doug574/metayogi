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
abstract class BaseElement extends BaseWidget
{
    /** Boolean (int) for whether a value for this element is required */
    protected $required;

    /** Boolean (int) for whether this element can have multiple values */
    protected $repeatable;

    /** desc */
    protected $value;

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
		$this->required = 0;
		$this->repeatable = 0;
        parent::build($properties);
        if (isset($this->data[$this->name])) {
            $this->value = $this->data[$this->name];
        }
    }

   /**
    * Adds attributes common to all elements and containers
    *
    * @access protected
    * @return string
    */
    protected function addAttributes()
    {
		$str = parent::addAttributes();
		if (isset($this->value) && ! is_array($this->value)) {
			$str .= " value='" . htmlentities(stripslashes($this->value), ENT_QUOTES, 'UTF-8', false) . "' ";
		}
		
		return $str;
	}

    
    /**
    * Adds a label to the rendered element
    *
    * @access public
    * @return string
    */
    public function addLabel()
    {
        $str = "";
        if (! empty($this->label)) {
            $str .= "<label for='" . $this->id . "'>";
            if ($this->required) {
                $str .= "<span title='This field is required.'>*</span>";
            }
            $str .= $this->label;
            $str .= "</label>";
        }

        return $str;
    }	

}