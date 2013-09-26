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
 * Description 
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
abstract class BaseDecorator
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

    protected $request;
    protected $session;
    
    /**
    * Data for display
    * @var array
    */
    protected $data;

    protected $halted;
    
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
    ) {
        $this->dbh = $dbh;
        $this->router = $router;
        $this->registry = $registry;
        $this->viewer = $viewer;
        $this->request = $request;
        $this->session = $session;
        $this->data = $data;
        $this->halted = 0;
    }
    
    public function isHalted()
    {
        return $this->halted;
    }
    
    public function halt()
    {
        $this-> halted = 1;
    }
}
