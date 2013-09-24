<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Form\Container;

use Metayogi\Form\WidgetInterface;

/**
 * Puts a fieldset around a container 
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class FieldsetContainer extends BaseContainer implements WidgetInterface
{
	/** desc */
	protected $legend;

    /**
    * desc
    *
    * @access public
    * @param array  $properties Desc
    * @return void
    */
    public function build($properties)
    {
		parent::build($properties);
		if (! empty($properties['legend'])) {
			$this->legend = $properties['legend'];
		}
	}
    
    /**
     * Description
     *
     * @return string
     * @access public
     */
    public function render()
    {
        $html = "";
		$html .= "<fieldset>\n";
		if (! empty($this->legend)) {
			$html .= "<legend>" . $this->legend . "</legend>\n";
		}
		$html .= $this->renderElements();
		$html .= "</fieldset>\n";
        return $html;
	}
	
	public function addLabel()
	{
		return "";
	}
	
	public function addHelp()
	{
	}

}
