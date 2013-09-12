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
 * Abstract class for methods common to form elements
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
abstract class BaseElement extends BaseWidget
{
    /**
    * Indicates whether a value for this element is required
    * @var boolean
    */
    protected $required;

    /** 
    * Indicates whether this element can have multiple values
    * @var boolean
    */
    protected $repeatable;

    /**
    * Indicates whether values can be modified once set
    * @var boolean
    */
    protected $immutable;

    /**
    * Value or values for this element
    * @var mixed
    */
    protected $value;

    /**
    * Sets the properties common to elements
    *
    * @access public
    * @param array  $properties Desc
    * @return void
    */
    public function build($properties)
    {
        $this->required = 0;
        $this->repeatable = 0;
        $this->immutable = 0;
        parent::build($properties);
        if (isset($this->data[$this->name])) {
            $this->value = $this->data[$this->name];
        } elseif (isset($properties['default'])) {
            $this->value = $properties['default'];
        }
 #       $this->classes[] = 'form-control';
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
            $str .= "<label for='" . $this->id . "' class='control-label'>";
            if ($this->required) {
                $str .= "<span title='This field is required.'>*</span>";
            }
            $str .= $this->label;
            $str .= "</label>";
        }

        return $str;
    }

    public function render()
    {
        $html = "";
        $html .= "<div class='form-group'>";
        $html .= $this->addLabel();
        $html .= "<div>\n";
        $html .= $this->addElement();
        $html .= "</div></div>";

        return $html;
    }
    
    /**
     * Validates that this element meets its constraints
     *
     * @access public
     * @return boolean
     */
    public function isValid()
    {
        $result = true;
        
        /* Is required? */
        if ($this->required && empty($this->value)) {
            $this->errors[] =  $this->label . " field is required.";
            $result = false;
        }

        return $result;
    }
    
    /**
    * Return value(s) for this element to container
    *
    * @access public
    * @return mixed
    */
    public function submit()
    {
        return $this->value;
    }
}
