<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Decorator;

use Metayogi\Database\DatabaseInterface;
use Metayogi\Routing\Router;
use Metayogi\Foundation\Registry;
use Metayogi\Viewer\ViewerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Defines the Decorator interface
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
interface DecoratorInterface
{
    /**
    * Makes global services available
    *
    * @access public
    * @param Metayogi\Database\DatabaseInterface               $dbh
    * @param Metayogi\Routing\Router                           $router
    * @param Metayogi\Foundation\Registry                      $registry
    * @param Metayogi\Viewer\ViewerInterface                   $viewer
    * @param Symfony\Component\HttpFoundation\Request          $request
    * @param Symfony\Component\HttpFoundation\Session\Session  $session
    * @param array                                             $data
    * @return void
    */
    public function __construct(
        DatabaseInterface $dbh,
        Router $router,
        Registry $registry,
        ViewerInterface $viewer,
        Request $request,
        Session $session,
        $data
    );

    /**
    * Sets the properties for this decorator
    *
    * @access public
    * @return void
    */
    public function build();

    /**
    * Returns the html content for this decorator
    *
    * @access public
    * @return string
    */
    public function render();
}
