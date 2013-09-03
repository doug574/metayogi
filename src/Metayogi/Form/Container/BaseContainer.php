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
        if (empty($properties['elements'])) {
            return;
        }
        foreach ($properties['elements'] as $name => $element) {
            $widget = $element['widget'];
            $element['name'] = $name;
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
            $selectee = $element->id . "-crl";
            if ($this->horizontal) {
                $html .= "<div id='$selectee' class='control-group" . $element->errstate . "'>\n";
                $html .= "<div class='control-label'>" . $element->addLabel() . "</div>";
                $html .= "<div class='controls'>" . $element->render();
                if ($this->popups) {
                    $html .= $element->addHelpPopover();
                } else {
                    $html .= $element->addHelp();
                }
                $html .= "</div>\n";
                $html .= "</div>\n";
            } else {
                $html .= "<div class='form-group'>";
                $html .= $element->addLabel();
                $html .= $element->render();
                $html .= "</div>";
            }
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
        return true;
    }
}
