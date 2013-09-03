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
class HeaderDecorator extends BaseDecorator implements DecoratorInterface
{
    /** desc*/
    protected $header;

    /**
     * Description
     *
     * @return void
     * @access public
     */
    public function build()
    {
        $this->header = "";
        $properties = $this->router->getRoute('view.HeaderDecorator');
        if (! empty($properties['header'])) {
            $this->header = $properties['header'];
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
        if (! empty($this->header)) {
            $html .= "<p>" . $this->header . "</p>\n";
        }

        return $html;
    }
}
