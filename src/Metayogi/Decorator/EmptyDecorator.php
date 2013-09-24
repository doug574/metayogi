<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Decorator;

 
/**
 *  Adds non-ID actions to operation displays
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class EmptyDecorator extends BaseDecorator implements DecoratorInterface
{
    /**
    * Test to display for empty result set
    * @var string
    */
    protected $empty;

    /**
    * {@inheritdoc}
    */
    public function build()
    {
        $this->header = "";
        $properties = $this->router->get('view.EmptyDecorator');
        if (! empty($properties['empty'])) {
            $this->empty = $properties['empty'];
        }
    }

    /**
    * {@inheritdoc}
    */
    public function render()
    {
        $html = "";
        if (! empty($this->empty)) {
            $html .= "<p>" . $this->empty . "</p>\n";
        }
        
        return $html;
    }
}
