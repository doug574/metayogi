<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Foundation;
 
/**
 * Description 
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class DisplayHandler
{
    /**
    * Database service
    * @var Metayogi\Database\DatabaseInterface
    */
    protected $dbh;

    /**
    * Router service
    * @var Metayogi\Routing\Router
    */
    protected $router;

    /**
    * Registry service
    * @var Metayogi\Foundation\Registry
    */
    protected $registry;

    /**
    * Viewer service
    * @var Metayogi\Viewer\ViewerInterface
    */
    protected $viewer;

    /**
    * Request data
    * @var array
    */
    protected $data;

    protected $request;
    protected $session;
    
    /**
    * List of decorators and display objects
    * @var array
    */
    protected $dlist;

    /**
     * Makes global services available via DI container
     *
     * @param Metayogi\Foundation\Application $app
     * @access public
     * @return void
     */
    public function __construct($app)
    {
        $this->dlist = array();
        $this->dbh = $app['dbh'];
        $this->router = $app['router'];
        $this->registry = $app['registry'];
        $this->viewer = $app['viewer'];
        $this->request = $app['request'];
        $this->session = $app['session'];
        $this->data = $app['data'];
    }
    
    /**
    * Create the display object list
    *
    * @access public
    * @return void
    */
    public function build()
    {
        $decorator = new \Metayogi\Decorator\FlashDecorator($this->dbh, $this->router, $this->registry, $this->viewer, $this->request, $this->session, $this->data);
        $decorator->build();
        $this->dlist[] = $decorator;
    
        $decorators = $this->router->getRoute('view.decorators');
        if (! empty($decorators['pre'])) {
            foreach ($decorators['pre'] as $decoratorName) {
                $decorator = new $decoratorName($this->dbh, $this->router, $this->registry, $this->viewer, $this->request, $this->session, $this->data);
                $decorator->build();
                $this->dlist[] = $decorator;
            }
        }
        
        $displayName = $this->router->getRoute('view.display');
        $display = new $displayName($this->dbh, $this->router, $this->registry, $this->viewer, $this->data);
        $display->build();
        $this->dlist[] = $display;
        
        if (! empty($decorators['post'])) {
            foreach ($decorators['post'] as $decoratorName) {
                $decorator = new $decoratorName($this->dbh, $this->router, $this->registry, $this->viewer, $this->request, $this->session, $this->data);
                $decorator->build();
                $this->dlist[] = $decorator;
            }
        }

    }

    /**
    * Generates content from list of display and decorator objects
    *
    * @access public
    * @return string
    */
    public function render()
    {
        if (empty($this->dlist)) {
            return "";
        }
        
        $html = "";
        foreach ($this->dlist as $obj) {
            $html .= $obj->render();
        }
        
        return $html;
    }
}
