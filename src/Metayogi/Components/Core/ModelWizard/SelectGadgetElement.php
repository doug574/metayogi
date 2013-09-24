<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Components\Core\ModelWizard;

use Metayogi\Form\Element\SelectElement;
use Metayogi\Form\BaseWidget;
use Metayogi\Form\WidgetInterface;

/**
 * desc
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class SelectGadgetElement extends SelectElement implements WidgetInterface
{
    /**
    * {@inheritdoc}
    */
    public function build($properties)
    {
		parent::build($properties);
		$gadgets = array_keys($this->registry->get('gadgets'));
		sort($gadgets);
        foreach ($gadgets as $gadgetName) {
            $key = $this->registry->get("gadgets.$gadgetName.namespace") . $gadgetName;
            $this->list[$key] = $gadgetName;
        }
	}

    /**
     * Generate html for this element
     * 
     * @return string Html string
     * @access public
     */
    public function render()
    {
        return parent::render();
    }
}