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
class TableDisplay extends MultiRecordDisplay implements DisplayInterface
{
    /** desc */
    protected $labels;

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
        if ($this->data->get('numFound') == 0) {
            return;
        }

        parent::build();
        
        /*
        * Create labels for table header
        * Uses schema for first record; assumes all record in list of same type
        */
        $docs = $this->data->get('docs');
        $rdfType = $docs[0]['rdf:type'];
        $fieldset = $this->fieldsets[$rdfType];
        foreach ($fieldset as $fieldName => $field) {
            $this->labels[] = $field['label'];
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
