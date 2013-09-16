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
    * {@inheritdoc}
    */
    public function build($properties)
    {
        parent::build($properties);
        if ($this->repeatable && empty($this->value)) {
            $this->value = array(0 => '');
        }
        if ($this->repeatable && (! is_array($this->value))) {
            $this->value = array($this->value);
        }
    }
    
    /**
     * 
     */
    public function addElement()
    {
        if (! $this->repeatable) {
            return $this->notRepeated();
        }
        
        $html = "";
        $tmpName = $this->name;
        $this->name .= '[]';
        foreach ($this->value as $value) {
            $html .= "<input type='text'";
            $html .= $this->addAttributes();
            $html .= " value='" . $value . "' ";
            $html .= " />\n";
            $html .= "<br />";
        }
        $this->name = $tmpName;
        $html .= "<input type='submit' name='addButton_" . $this->name . "' value=' + ' class='button' />";
        if (count($this->value) > 1 ) {
            $html .= "<input type='submit' name='delButton_" . $this->name . "' value=' - ' class='button' />";
        }

        return $html;
    }
    
    protected function notRepeated()
    {
        $html = "";
		$html .= "<input type='text'";
		$html .= $this->addAttributes();
        if ($this->immutable && $this->value != "") {
            $html .= " readonly=readonly";
        }
        $html .= " />";

        return $html;
    }
    
    public function submit()
    {
        if ($this->repeatable && (! is_array($this->value))) {
            $this->value = array($this->value);
        }
        
        return $this->value;
    }
}
