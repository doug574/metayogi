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
 * Class for an html Select element
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class SelectElement extends BaseElement implements WidgetInterface
{
    /** desc */
    protected $size;

    /** desc */
    protected $onchange;

    /** desc */
    protected $list;

    public function build($properties)
    {
        $this->size = 1;
        $this->onchange = 0;
        $this->list = array();
        $this->value = array();
        parent::build($properties);

       $this->classes[] = 'form-control';
       if ($this->repeatable) {
            $this->attributes['multiple'] = 'multiple';
            $this->size = 5;
#           $app->layout->buildCSS(array(myURL::link('bsmSelect/jquery.bsmselect.css')));
#           $app->layout->buildJS(array (
#               myURL::link('bsmSelect/jquery.bsmselect.js'),
#               myURL::link('bsmSelect/jquery.bsmselect.sortable.js'),
#               myURL::link('bsmSelect/jquery.bsmselect.compatibility.js')
 #           ));
#            $app->layout->addJS($this->addBsmSelect());
            /* $app->layout->jquery->attach($this, 'addBsmSelect'); */
        }
        if (! is_array($this->value)) {
            $this->value = array($this->value);
        }
        if (! empty($properties['optionlist'])) {
            $this->list = $properties['optionlist'];
        }
        if (! empty($properties['optionslist'])) {
            $this->list = $properties['optionslist'];
        }
        if (array_key_exists('0', $this->list)) {
            $this->list = array_combine($this->list, $this->list);
        }
#       if (! empty($properties['submitonchange'])) {
#           $app->layout->addJS($this->onChange());
#           $this->onchange = 1;
#       }
        if ($this->immutable && ! empty($this->value)) {
            $this->attributes['disabled'] = 'disabled';
        }
        unset($this->attributes['optionslist']);
    }

    /**
    *
    */
    public function addElement()
    {
        $html = "";
        $html .= "<select";
        if ($this->repeatable) {
            $this->name = $this->name . '[]';
        }
        $html .= $this->addAttributes();
        $html .= ">";
        if (! $this->repeatable) {
            $html .= "<option value=''>Choose one ...</option>\n";
        }
        foreach ($this->list as $key => $value) {
            $html .= "<option value='" . $key . "' ";
            if (in_array($key, $this->value)) {
               $html .= " selected='selected' " . ">";
            } else {
               $html .= ">";
            }
            $html .= $value;
            $html .= "</option>";
        }
        $html .= "</select>";

        if ($this->immutable && ! empty($this->value) && ! $this->repeatable) {
            $html .= "<input type='hidden' ";
            $html .= "name='" . $this->name . "' ";
            $html .= "value='" . $this->value[0] . "' ";
            $html .= "/>\n";
        }

        return $html;
    }

    /**
    * {@inheritdoc}
    */
    public function isValid()
    {
        $result = true;
        if ($this->required && empty($this->value[0])) {
            $this->errors[] =  $this->label . " field is required.";
            $result = false;
        }

        return $result;
    }

    /**
    * {@inheritdoc}
    */
    public function submit()
    {
        if ($this->repeatable) {
            return $this->value;
        }
        if (! empty($this->value)) {
            return $this->value[0];
        }

        return "";
    }
}
