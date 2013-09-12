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
class TitleDecorator extends BaseDecorator implements DecoratorInterface
{
    /** desc */
    protected $title;

    /**
     * Description
     *
     * @return void
     * @access public
     */
    public function build()
    {
        $this->title = array();
        $properties = $this->router->get('view.TitleDecorator');
        if (! empty($properties['label']) && empty($properties['hidden'])) {
            $this->title['label'] = $properties['label'];
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
        if (! empty($this->title['label'])) {
            $html = "<h1>" . $this->title['label'] . "</h1>\n";
        }

        return $html;
    }
}
