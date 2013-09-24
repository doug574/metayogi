<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Components\Core\ModelWizard;

use Metayogi\Display\BaseDisplay;
use Metayogi\Display\DisplayInterface;

/**
 * Class for displaying a record using a view passed via controller object
 *
 * @package Components\ModelWizard
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class PropertyDisplay extends BaseDisplay implements DisplayInterface
{
	/** desc */
	protected $fields;

	protected $name;
	

    /**
     * Description
     *
     * @param object $app Description
     *
     * @return void
     * @access public
     */
    public function build()
    {
		$this->fields = array();
		$doc = $this->data->getStore();
		$this->name = $doc['name'];
		$fieldset = $this->router->get('view.PropertyDisplay.fields');
		foreach ($fieldset as $name => $field) {
			$field['name'] = $name;
            $gadget = new $field['gadget']($this->dbh, $this->router, $this->registry);
			$gadget->build($field, $doc);
			if ($gadget->isDisplayed()) {
				$this->fields[] = $gadget; 
			}
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
        $html  = "<table class='table table-bordered table-condensed table-hover'>\n";
		$html .= "<thead><tr><th colspan='2'>Property name: " . $this->name ."</th></tr></thead>\n";

        foreach ($this->fields as $field) {
           $html .= "<tr><td>" . $field->getLabel() . "</td><td>" . $field->render() . "</td></tr>";
        }
        $html .= "</table>\n";

		return $html;
	}
}
