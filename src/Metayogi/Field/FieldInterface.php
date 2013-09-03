<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Field;

use Metayogi\Database\DatabaseInterface;
use Metayogi\Routing\Router;
use Metayogi\Foundation\Registry;

/**
 * Defines the Field interface
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
interface FieldInterface
{
    /**
    * Makes global services available  
    *
    * @access public
    * @param Metayogi\Database\DatabaseInterface               $dbh
    * @param Metayogi\Routing\Router                           $router
    * @param Metayogi\Foundation\Registry                      $registry
    * @return void
    */
    public function __construct(DatabaseInterface $dbh, Router $router, Registry $registry);

    /**
     * Sets field properties
     *
     * @param array $properties Description
     * @param array $doc        Desc
     *
     * @return void
     * @access public
     */
    public function build($properties, $doc);

    /**
    * Gets field value as string
    *
    * @access public
    * @return string
    */
    public function render();
}
