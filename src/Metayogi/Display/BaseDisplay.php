<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Display;

use Metayogi\Database\DatabaseInterface;
use Metayogi\Routing\Router;
use Metayogi\Foundation\Registry;
use Metayogi\Viewer\ViewerInterface;

/**
 * Defines the Display interface
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
abstract class BaseDisplay
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
    * Data for display
    * @var array
    */
    protected $data;

    /**
    * Makes global services available  
    *
    * @access public
    * @param Metayogi\Database\DatabaseInterface               $dbh
    * @param Metayogi\Routing\Router                           $router
    * @param Metayogi\Foundation\Registry                      $registry
    * @param Metayogi\Viewer\ViewerInterface                   $viewer
    * @param array                                             $data
    * @return void
    */
    public function __construct(
        DatabaseInterface $dbh,
        Router $router,
        Registry $registry,
        ViewerInterface $viewer,
        $data
    ) {
        $this->dbh = $dbh;
        $this->router = $router;
        $this->registry = $registry;
        $this->viewer = $viewer;
        $this->data = $data;
    }
}
