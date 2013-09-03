<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Display;

/**
 * Generic table display class
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class TableDisplay extends BaseDisplay implements DisplayInterface
{
    /** desc */
    protected $labels;

    /** desc */
    protected $records;

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
        if ($this->data['numFound'] == 0) {
            return;
        }

        $view = $this->router->getRoute('view');
        $properties = $view['TableDisplay'];
        $fieldset = $properties['fields'];

        /*
        * Create labels for table header
        */
        foreach ($fieldset as $fieldName => $field) {
            $this->labels[] = $field['label'];
        }

        /*
        * Create field objects
        */
        foreach ($this->data['docs'] as $doc) {
            $fields = array();
            foreach ($fieldset as $fieldName => $field) {
                $field['name'] = $fieldName;
                $gadget = new $field['gadget']($this->dbh, $this->router, $this->registry);
                $gadget->build($field, $doc);
                $fields[] = $gadget;
            }
            $this->records[] = $fields;
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
        if (empty($this->labels)) {
            return "";
        }

        $html = "";
        $html .= "<table class='table'>\n";
        $html .= "<thead>\n";
        $html .= "<tr>";
        foreach ($this->labels as $label) {
            $html .= "<th>" . $label . "</th>";
        }
        $html .= "</tr>";
        $html .= "</thead>\n";

        $html .= "<tbody>\n";
        foreach ($this->records as $record) {
            $html .= "<tr>\n";
            foreach ($record as $field) {
                $html .= '<td>' . $field->render() . '</td>';
            }
            $html .= "</tr>\n";
        }

        $html .= "</tbody>\n";
        $html .= "</table>\n";
        return $html;
    }
}
