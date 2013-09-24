<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Components\Core\Controller;

use Metayogi\Display\BaseDisplay;
use Metayogi\Display\DisplayInterface;

/**
 * desc
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class ControllerDisplay extends BaseDisplay implements DisplayInterface
{
    /** desc */
    protected $results;

    /** desc */
    protected $path;

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
        $this->results = $this->data->getStore();
        $this->path = '/' . $this->router->get('controller.CRUDpath') . '/';
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

        $html .= "<table class='table table-bordered table-condensed table-hover'>\n";
        $html .= "<thead><tr><th>Collection</th><th>Records</th><th>Cache</th><th>Records</th><th>Operations</th></tr></thead>\n";

#        foreach ($this->results as $result) {
#            $html .= "<tr><td>" . $result['name'] . "</td><td>" . $result['size'] . "</td><td>" . $result['name'] . ".cache</td><td>" . $result['cache'] . "</td><td>";
#            $url = $this->path . 'flush?' . http_build_query(array('cache'=>$result['name']));
#            $html .= "<a href='$url' class='btn btn-small'>" . 'Clear cache' . "</a> ";
#            $html .= "</td></tr>\n";
        }
        $html .= "</table>\n";

        return $html;
    }
}
