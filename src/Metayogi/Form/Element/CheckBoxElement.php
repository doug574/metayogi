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
 * Class for an html checkbox element
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class CheckBoxElement extends BaseElement implements WidgetInterface
{
    /**
    * {@inheritdoc}
    */
    public function build($properties)
    {
        parent::build($properties);
    }

    /**
     *
     */
    public function addElement()
    {
        $html = "";
        $html .= "<input type='checkbox' ";
        $html .= $this->addAttributes();
        if ($this->value) {
            $html .= " checked='1' ";
        }
        $html .= " />";

        return $html;
    }

    /**
    * {@inheritdoc}
    */
    public function isValid()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function submit()
    {
        return (!empty($this->value)) ? 1 : 0;
    }
}
