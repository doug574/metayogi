<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Viewer;

use Metayogi\Foundation\Application;
use Metayogi\Display\DisplayInterface;
 
/**
 * Builds html pages
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
abstract class BaseViewer
{
    protected $dbh;
    protected $router;
    protected $regions;
    protected $data;
    protected $display;
    
    /**
     * Description
     *
     * @return void
     */
    public function __construct(Application $app)
    {
        $this->dbh = $app['dbh'];
        $this->router = $app['router'];
        $this->data = $app['data'];
        $this->regions = array();
    }

    public function addContent(DisplayInterface $display)
    {
        $this->display = $display;
    }
}
