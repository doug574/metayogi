<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Components\Core\ModelWizard;
 
use Metayogi\Decorator\BaseDecorator;
use Metayogi\Decorator\DecoratorInterface;

/**
 * Description 
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class ClassBreadcrumbDecorator extends BaseDecorator implements DecoratorInterface
{
    protected $breadcrumb;
    protected $label;

    protected $parent;


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
        $this->breadcrumb = array();
        $this->parent = 'parent';
        if ($this->router->has('view.ClassBreadcrumbDecorator.parent')) {
            $this->parent = $this->router->get('view.ClassBreadcrumbDecorator.parent');
        }
        $this->label = 'label';
        if ($this->router->has('view.ClassBreadcrumbDecorator.label')) {
            $this->label = $this->router->get('view.ClassBreadcrumbDecorator.label');
        }
        
        $url = '/' . 'admin/classes/display';
        $this->breadcrumb[] = array( array('label' => $this->router->get("instance.$this->label"), 'url' => ''));
#print_r($app->route['instance']);        
        if ($this->router->has("instance.$this->parent")) {
            $parents = array();
            foreach ($this->router->get("instance.$this->parent") as $ancestor) {
                $parents[] = array('label' => $ancestor[$this->label], 'url' => $url . '?id=' . (string) $ancestor['_id']);
            }
            $this->breadcrumb[] = $parents;
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
        $l = 0;
        foreach ($this->breadcrumb as $level) {
        $c = 0;
        foreach ($level as $child) {
            $sep = "";
            if ($l > 0 && $c == 0) {
                $sep = " > ";
            } else if ($c > 0) {
                $sep = ", ";
            }
            if (empty($child['url'])) {
                $html = $child['label'] . $sep . $html;
            } else {
                $url = $child['url'];
                $html = "<a href='$url'>" . $child['label'] . "</a>\n" . $sep . $html;
            }
            $c++;
        }
        $l++;
        }
        $html = "<h3>$html</h3>\n";

        return $html;
    }
}
