<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Display;

/**
 * Generic list display class
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class ListDisplay extends BaseDisplay implements DisplayInterface
{

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

        $properties = $this->router->getRoute('view.ListDisplay');

        /*
        * Determine if using fields or fieldsets
        */
        if (!empty($properties['fields'])) {
        }

        /*
        * Determine how many different record types we have in the data
        */
        $types = array();
        foreach ($this->data['docs'] as $result) {
            $types[$result['rdf:type']]++;
        }
        print "<p>" . count($types) . "</p>";
        print_r($this->router->getRoute('view'));
    }

    /**
     * Description
     *
     * @return string
     * @access public
     */
    public function render()
    {
        $html = "List\n";
        print_r($this->data);
        return $html;
    }
}
