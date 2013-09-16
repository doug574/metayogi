<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Form\Container;

use Metayogi\Form\BaseWidget;
use Metayogi\Form\WidgetInterface;

/**
 * Base class for container widgets where a container is as list of elements
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
abstract class BaseContainer extends BaseWidget
{
    /**
    * List of element objects
    * @var array
    */
    protected $elements;

    /**
    * Creates the element list
    *
    * @access public
    * @param array  $properties
    * @return void
    */
    public function build($properties)
    {
        parent::build($properties);

        $this->elements = array();
        if (empty($properties['elements']) && empty($properties['elementset'])) {
            return;
        }
        if (! empty($properties['elementset'])) {
            $elems = $properties['elementset']['elements'];
        } else {
            $elems = $properties['elements'];
        }
        foreach ($elems as $name => $element) {
            $widget = $element['widget'];
            $element['name'] = $name;
            if (isset($properties['layout'])) {
                $element['layout'] = $properties['layout'];
            }
            $this->elements[$name] = new $widget(
                $this->dbh,
                $this->router,
                $this->registry,
                $this->viewer,
                $this->data
            );
            $this->elements[$name]->build($element);
        }
    }

    public function addElement($name, $element)
    {
        $this->elements[$name] = $element;
    }
    
    /**
    * Generates content element list
    *
    * @access protected
    * @return string
    */
    protected function renderElements()
    {
        $html = "";
        foreach ($this->elements as $element) {
            $html .= $element->render();
        }

        return $html;
    }

    /**
    * Checks that elements within container have valid values
    *
    * @access public
    * @return boolean
    */
    public function isValid()
    {
       $result = true;
        foreach ($this->elements as $element) {
            if (! $element->isValid()) {
                $result = false;
				$this->errors = array_merge($this->errors, $element->getErrors());
            }
        }

        return $result;
    }

   /**
    * Returns an array of values for the elements in this container
    *
    * @access public
    * @return array
    */
    public function submit()
    {
        $data = array();
        foreach ($this->elements as $element) {
            $data[$element->name] = $element->submit();
        }
        
        return $data;
    }
}
