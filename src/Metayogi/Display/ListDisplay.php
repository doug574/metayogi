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
class ListDisplay extends MultiRecordDisplay implements DisplayInterface
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
        parent::build();

        /* Make first field a link to full record display */
        /* Gets text of link from original gadget */
#        $field = '\\Metayogi\\Field\\LinkField';
#        $gadget = new $field($this->dbh, $this->router, $this->registry);
#        $gadget->build($field, $doc);

    }

    /**
     * Description
     *
     * @return string
     * @access public
     */
    public function render()
    {
        $html = "<ul class='list-group'>\n";
        foreach ($this->records as $record) {
            $html .= "<li class='list-group-item'>\n";
            foreach ($record as $field) {
                $html .= '<div>' . $field->render() . "</div>\n";
            }
            $html .= "</li>\n";
        }
        $html .= "</ul>\n";
       
        return $html;
    }
}
