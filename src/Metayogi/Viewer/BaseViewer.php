<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Viewer;

use Metayogi\Foundation\Application;
use Metayogi\Foundation\DisplayHandler;
 
/**
 * Builds html pages
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
abstract class BaseViewer
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
    * Response service
    * @var Symfony\Component\HttpFoundation\Response
    */
    protected $response;

    /**
    * Regions in response layout
    * @var array
    */
    protected $regions;

    /**
    * Data
    * @var array
    */
    protected $data;

    /**
    * Router service
    * @var Metayogi\Display\DisplayInterface
    */
    protected $display;
    protected $app;
    protected $session;
    
    /**
     * Makes global services available via DI container
     *
     * @param Metayogi\Foundation\Application $app
     * @access public
     * @return void
     */
    public function __construct(Application $app)
    {
        $this->dbh = $app['dbh'];
        $this->router = $app['router'];
        $this->response = $app['response'];
        $this->data = $app['data'];
        $this->session = $app['session'];
        $this->regions = array();
        $this->app = $app;
    }

    /**
    * Adds content from request url
    *
    * @param Metayogi\Display\DisplayHandler $display
    * @access public
    * @return void
    */
    public function addContent(DisplayHandler $display)
    {
        $this->display = $display;
    }
}
