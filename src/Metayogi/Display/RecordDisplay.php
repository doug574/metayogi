<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Display;

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
     * Constructor
     *
     * @return object
     * @access public
     */
    public function __construct()
    {
		$this->fields = array();
    }

    /**
     * Description
     *
     * @param object $app Description
     *
     * @return void
     * @access public
     */
    public function build($app)
    {
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

           $html .= $field->render();
        }
        $html .= "</div>\n";

        return $html;
    }

}