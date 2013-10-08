<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Display;

use Metayogi\Database\DatabaseInterface;
use Symfony\Component\HttpFoundation\Request;
use Metayogi\Routing\Router;
use Metayogi\Foundation\Registry;
use Metayogi\Viewer\ViewerInterface;

/**
 * Defines the Display interface
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
interface DisplayInterface
{
   /**
    * Makes global services available  
    *
    * @access public
    * @param Metayogi\Database\DatabaseInterface               $dbh
    * @param Symfony\Component\HttpFoundation\Request          $request
    * @param Metayogi\Routing\Router                           $router
    * @param Metayogi\Foundation\Registry                      $registry
    * @param Metayogi\Viewer\ViewerInterface                   $viewer
    * @param array                                             $data
    * @return void
    */
    public function __construct(
        DatabaseInterface $dbh,
        Request $request,
        Router $router,
        Registry $registry,
        ViewerInterface $viewer,
        $mediator,
        $data
    );

    /**
     * Description
     *
     * @param object $app Description
     *
     * @return void
     * @access public
     */
    public function build();

    /**
     * Description
     *
     * @return string
     * @access public
     */
    public function render();
}
