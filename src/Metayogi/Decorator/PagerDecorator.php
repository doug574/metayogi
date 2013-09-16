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
 */
class PagerDecorator extends BaseDecorator implements DecoratorInterface
{
    /** desc */
    protected $prev;

    /** desc */
    protected $next;

    /** desc */
    protected $first;

    /** desc */
    protected $last;

    /** desc */
    protected $current;

    /** desc */
    protected $count;

    /** desc */
    protected $pagesize;


    /**
     * Description
     *
     * @return void
     * @access public
     */
    public function build()
    {
        $data = $this->data->getStore();
        $params = $this->request->query->all();

        $pagenum = $data['pagenum'];
        $pagesize = $data['rows'];
        $count = $data['numFound'];
        $this->pagesize = $pagesize;
        $this->count = $count;

        if ($this->count < $this->pagesize) {
            return;
        }
        $path = $this->request->getBaseUrl();

        $first = ($pagenum * $pagesize) + 1;
        $last = ($pagenum * $pagesize) + $pagesize;
        if ($last > $count) {
            $last = $count;
        }
        $this->current = "Displaying $first to $last of $count";

        if ($pagenum > 0) {
            $params['pagenum'] = 0;
            $this->first = $path . '?' . http_build_query($params);
            $params['pagenum'] = $pagenum - 1;
            $this->prev = $path . '?' . http_build_query($params);
        }
        if ($count > (($pagenum+1) * $pagesize)) {
            $params['pagenum'] = $pagenum + 1;
            $this->next = $path . '?' . http_build_query($params);
            $params['pagenum'] = floor(($count-1) / $pagesize);
            $this->last = $path . '?' . http_build_query($params);
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
        if ($this->count < $this->pagesize) {
            return "";
        }

        $html = "<ul class='pager' >\n";

        $disabled = isset($this->first) ? "" : " disabled";
        $html .= "<li class='previous" . $disabled . "'>";
        $html .= "<a href='" . $this->first . "'>First</a>";
        $html .= "</li>\n";

        $disabled = isset($this->prev) ? "" : " disabled";
        $html .= "<li class='previous" . $disabled . "'>";
        $html .= "<a href='" . $this->prev . "'>Previous</a>";
        $html .= "</li>\n";

        $html .= "<li class='active'>\n";
        $html .= "<a href='#'>" . $this->current . "</a>";
        $html .= "</li>\n";

        $disabled = isset($this->last) ? "" : " disabled";
        $html .= "<li class='next" . $disabled . "'>";
        $html .= "<a href='" . $this->last . "'>Last</a>";
        $html .= "</li>\n";

        $disabled = isset($this->next) ? "" : " disabled";
        $html .= "<li class='next" . $disabled . "'>";
        $html .= "<a href='" . $this->next . "'>Next</a>";
        $html .= "</li>\n";

        $html .= "</ul>\n";

        return $html;
    }
}
