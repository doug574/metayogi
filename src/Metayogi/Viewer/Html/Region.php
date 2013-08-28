<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Viewer\Html;

use Metayogi\Foundation\Application;
use Metayogi\Viewer\Html\Block;

/**
 * Builds html pages
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class Region
{
    /** desc */
    protected $blocks;
    protected $properties;
    
    public function __construct()
    {
        $this->blocks = array();
    }

    /**
     * Description
     *
     * @param Metayogi\Foundation\Application $app        Description
     * @param array                           $properties Description
     *
     * @return void
     * @access public
     */
    public function build(Application $app, $properties)
    {
        $this->properties = $properties;
        foreach ($properties['blocks'] as $blockID => $blockprop) {
            if (! empty($blockID)) {
                $block = new Block($app);
                $block->build($blockprop);
                $this->blocks[$blockID] = $block;
            }
        }

    }
    
    /**
     * description
     *
     * @return string
     * @access public
     */
    public function render()
    {
        $classes = "";
        if (! empty($this->properties['classes'])) {
            $classes = " class='" . implode(" ", $this->properties['classes']) . "' ";
        }
        
        $html = "";
        $html .= "<div id='" . $this->properties['name'] ."'" . $classes .">\n";
        foreach ($this->blocks as $obj) {
            if (is_object($obj)) {
                $html .= $obj->render();
            }
        }
        $html .= "</div>\n";
        
        return $html;
    }
    
    /**
     * Description
     *
     * @param object $obj Description
     *
     * @return object
     * @access public
     */
    public function addContent($obj)
    {
        $this->blocks['content'] = $obj;
    }

}
