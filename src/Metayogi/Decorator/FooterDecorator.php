<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Decorator;

 
/**
 * Description 
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class FooterDecorator extends BaseDecorator implements DecoratorInterface
{
    /** desc */
    protected $footer;

    /**
     * Description
     *
     * @return void
     * @access public
     */
    public function build()
    {
        $this->footer = array();
        $properties = $this->router->get('view.FooterDecorator');
        if (! empty($properties['footer'])) {
            $this->header = $properties['footer'];
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
        if (! empty($this->footer)) {
            $html .= "<p>" . $this->footer . "</p>\n";
        }

        return $html;
    }
}
