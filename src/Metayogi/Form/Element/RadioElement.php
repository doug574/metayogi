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
 * Class form an html radio element
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class RadioElement extends BaseElement implements WidgetInterface
{
    /** desc */
    protected $options;

    /**
    * {@inheritdoc}
    */
    public function build($properties)
    {
        parent::build($properties);
        $this->options = $properties['options'];
    }

    /**
     *
     */
    public function addElement()
    {
        $html = "";
        $myvalue = $this->value;
        $this->value = null;
        foreach ($this->options as $option) {
            $html .= "<input type='radio' ";
            $this->id = 'id' . uniqid();
            $html .= $this->addAttributes();
            if ($myvalue == $option) {
                $html .= " checked='checked'";
            }
            $html .= " value='$option'> $option</input> \n";
        }

        return $html;
    }
}
