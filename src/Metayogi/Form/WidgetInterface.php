<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Form;

use Metayogi\Database\DatabaseInterface;
use Metayogi\Routing\Router;
use Metayogi\Foundation\Registry;
use Metayogi\Viewer\ViewerInterface;
use Metayogi\Foundation\DataArray;

/**
 * Defines the interface for form widgets
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
interface WidgetInterface
{
    /**
    * Makes global services available  
    *
    * @access public
    * @param Metayogi\Database\DatabaseInterface               $dbh
    * @param Metayogi\Routing\Router                           $router
    * @param Metayogi\Foundation\Registry                      $registry
    * @param Metayogi\Viewer\ViewerInterface                   $viewer
    * @param Metayogi\Foundation\DataArray                     $data
    * @return void
    */
    public function __construct(
        DatabaseInterface $dbh,
        Router $router,
        Registry $registry,
        ViewerInterface $viewer,
        DataArray $data
    );

    /**
    * Sets the widget properties
    *
    * @access public
    * @param array  $properties
    * @return void
    */
    public function build($properties);

    /**
    * Generates content
    *
    * @access public
    * @return void
    */
    public function render();
}