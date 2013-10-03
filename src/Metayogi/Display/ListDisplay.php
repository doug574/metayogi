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
    }

    /**
     * Description
     *
     * @return string
     * @access public
     */
    public function render()
    {
        $html = "<ul>\n";
        $html .= "</ul>\n";
        foreach ($this->records as $record) {
            $html .= "<li>\n";
            foreach ($record as $field) {
                $html .= '<div>' . $field->render() . "</div>\n";
            }
            $html .= "</li>\n";
        }
       
        return $html;
    }
}
