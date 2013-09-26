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
        $this->behaviours = $this->registry->get('behaviours');
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
        $html .= "<thead><tr><th>Class</th><th>Behaviour</th><th>Operations</th></thead>\n";

        foreach ($this->results['docs'] as $result) {
            $html .= "<tr><td colspan='3'>" . $result['label'] . "</td><tr>";
            foreach ($this->behaviours as $behaviour => $x) {
                $html .= "<tr><td>&nbsp;</td><td>$behaviour</td>";
                if (empty($result['behaviours'][$behaviour])) {
                    $url = '/admin/controllers/toggle?' . http_build_query(array('id'=> (string) $result['_id'], 'bid' => $behaviour, 'state' => 'off')); 
                    $html .= "<td><a href='$url' class='btn btn-default btn-sm'>" . 'Enable' . "</a></td></tr>";
                } else {
                    $url = '/admin/controllers/toggle?' . http_build_query(array('id'=> (string) $result['_id'], 'bid' => $behaviour, 'state' => 'on')); 
                    $html .= "<td><a href='$url' class='btn btn-default btn-sm'>" . 'Disable' . "</a></td></tr>";
                }
            }
        } 
        $html .= "</table>\n";

        return $html;
    }
}
