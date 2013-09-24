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
 * Class for adding a time stamp to a form submission. Its expected use is for 'date last updated'
 * data elements.
 *
 * @package Html\Elements
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class TimeStampElement extends BaseElement
{

    /**
     * Short description for function
     *
     * @return long
     * @access public
     */
    public function submit()
    {
        /* Value initially set to 1 so can be required element */
		if ($this->immutable) {
			$this->value = ($this->value == 1) ? time() : $this->value;
		} else {
			$this->value = time();
		}
		
        return $this->value;
    }

    /**
     * Generate html for this element
     *
     * @return string Html string
     * @access public
     */
    public function addElement()
    {
        $html = "";
        $stamp = ($this->value == 0 || $this->value == 1) ? "new" : date('Y-M-d H:i:s', $this->value);
         /* Value initially set to 1 so can be required element */
        $this->value = ($this->value == 0) ? 1 : $this->value;
        $html .= "<span>$stamp</span>";
        $html .= "<input type='hidden'";
        $html .= $this->addAttributes();
        $html .= " />";

        return $html;

    }
}
