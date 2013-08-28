<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Components\Core\Menu;

use Metayogi\Display\BaseDisplay;
use Metayogi\Display\DisplayInterface;

/**
 * Generic record display class
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class NavbarDisplay extends BaseDisplay implements DisplayInterface
{
    /** desc */
    protected $view;

    /** desc */
    protected $sitename;

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
        $this->viewer->addJS("  \$('.dropdown-toggle').dropdown();\n");
        $this->view = $this->router->getRoute('view');

        $this->sitename = $this->registry->get('Pages.sitename');
        
        return $this;
    }
    
   /**
     * Description
     *
     * @return string
     * @access public
     */
    public function render()
    {
        $classes = isset($this->view['inverse']) ? "navbar navbar-inverse" : "navbar";

        $html = "";
        $html = "<nav class='" . $classes . "' role='navigation'>\n";
        $html .= "<div class='container'>\n";
        
        $html .= "<div class='navbar-header'>\n";
        if (isset($this->sitename)) {
            $html .= "<a class='navbar-brand' href='/' >" . $this->sitename . "</a>\n";
        }
        $html .= "</div>\n";

        $html .= "<div class='collapse navbar-collapse navbar-ex1-collapse'>\n";
        $html .= "<ul class='nav navbar-nav'>\n";
        foreach ($this->data['menuitems'] as $item) {
            $method = $item['method'];
            $html .= $this->$method($item);
        }
        $html .= "</ul>\n";        
        $html .= "</div>\n";

        $html .= "</div>\n";
        $html .= "</nav>\n";
 
        return $html;
    }

    
    /**
     * Description
     *
     * @param array $item Description
     *
     * @return string
     * @access protected
     */
    protected function dropdown($item)
    {
        $html = "<li class='dropdown'>\n";
        $html .= "<a href='#' class='dropdown-toggle' data-toggle='dropdown'>";
        $html .= $item['menuitemtitle'];
        $html .= "<b class='caret'></b></a>\n";
        $html .= "<ul class='dropdown-menu'>\n";
        foreach ($item['menuitems'] as $subitem) {
            $method = $subitem['method'];
            $html .= $this->$method($subitem);
        }
        $html .= "</ul>\n";
        $html .= "</li>\n";

        return $html;
    }

    /**
     * Description
     *
     * @param array $item Description
     *
     * @return string
     * @access protected
     */
    protected function submenu($item)
    {
        $html  = "<li class='dropdown-submenu'>\n";
        $html .= "<a tabindex='-1' href='#'>" . $item['menuitemtitle'] . "</a>\n";
        $html .= "<ul class='dropdown-menu'>\n";
        foreach ($item['menuitems'] as $subitem) {
            $method = $subitem['method'];
            $html .= $this->$method($subitem);
        }
        $html .= "</ul>\n";
        $html .= "</li>\n";

        return $html;
    }

    /**
     * Description
     *
     * @param array $item Description
     *
     * @return string
     * @access protected
     */
    protected function link($item)
    {
        $html = "<li>";
        $html .= "<a href='" . $item['menuitempath'] . "'>";
        $html .= $item['menuitemtitle'];
        $html .= "</a>";
        $html .= "</li>\n";

        return $html;
    }

    /**
     * Description
     *
     * @param array $item Description
     *
     * @return string
     * @access protected
     */
    protected function divider($item)
    {
        return "<li class='divider'></li>\n";
    }

}