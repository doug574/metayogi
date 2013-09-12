<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Display;

use Metayogi\Database\DatabaseInterface;
use Metayogi\Routing\Router;
use Metayogi\Foundation\Registry;

/**
 * Generic record display class
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class RecordDisplay extends BaseDisplay implements DisplayInterface
{
    /** desc */
    protected $fields;

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

        $view = $this->router->get('view');
        $properties = $view['RecordDisplay'];
        $fieldset = $properties['fields'];
        $doc = $this->data;

        foreach ($fieldset as $fieldName => $field) {
            $field['name'] = $fieldName;
            $gadget = new $field['gadget']($this->dbh, $this->router, $this->registry);
            $gadget->build($field, $doc);
            $this->fields[] = $gadget;
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
        $html = "<div class='record'>\n";
        foreach ($this->fields as $field) {
            $html .= "<div>";
            $html .= $field->getLabel() . ": ";
            $html .= $field->render();
            $html .= "</div>\n";
        }
        $html .= "</div>\n";

        return $html;
    }
}
