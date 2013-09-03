<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Form\Container;

use Metayogi\Form\WidgetInterface;

/**
 * Container whose elements are displayed on a single line
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class HorizontalContainer extends BaseContainer implements WidgetInterface
{
    /**
    * {@inheritdoc}
    */
    public function render()
    {
        $html = "<div class='form-inline'>";
        $html .= $this->renderElements();
        $html .= "</div>\n";
        
        return $html;
    }
    
    
    public function addLabel()
    {
        return "";
    }
    
    public function addHelp()
    {
    }
}
