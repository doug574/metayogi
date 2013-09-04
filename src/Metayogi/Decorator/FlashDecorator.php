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
class FlashDecorator extends BaseDecorator implements DecoratorInterface
{
    /**
     * Description
     *
     * @return void
     * @access public
     */
    public function build()
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
        $html = "";
        // retrieve messages
        if ($this->session->getFlashBag()->has('notice')) {
            $html .= "<div class='alert alert-success alert-dismissable'>\n";
            $html .= "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>\n";
            foreach ($this->session->getFlashBag()->get('notice', array()) as $message) {
                $html .= "<div>$message</div>\n";
            }
            $html .= "</div>\n";
        }
        
        return $html;
    }
}
