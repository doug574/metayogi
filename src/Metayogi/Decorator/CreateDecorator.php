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
class CreateDecorator extends BaseDecorator implements DecoratorInterface
{
    /** 
    * List of actions to display
    * @var array
    */
    protected $actions;
    
    /**
    * {@inheritdoc}
    */
    public function build()
    {
        $routes = $this->router->get('controller.actions');
        foreach ($routes as $actionName => $path) {
            $action = $this->registry->get("actions.$actionName");
            if (empty($action['params']['id']) && (! empty($action['verb']))) {
                $action['url'] = '/' . $this->router->get('controller.CRUDpath') . '/' . $action['verb'];
                $this->actions[] = $action; 
            }
        }
    }

    /**
    * {@inheritdoc}
    */
    public function render()
    {
        $html = "";
        if (empty($this->actions)) {
            return $html;
        }

        foreach ($this->actions as $action) {
            $html .= "<a href='" . $action['url'] . "' class='btn btn-default btn-sm'>" . $action['label'] . "</a> ";
        }
        
        return $html;
    }
}
