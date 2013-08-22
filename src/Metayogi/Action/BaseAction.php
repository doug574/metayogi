<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Action;

use Metayogi\Database\DatabaseInterface;
use Metayogi\Routing\Route;
 
/**
 * Lists records in a collection
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
abstract class BaseAction
{
    protected $dbh;

    /**
     * Description
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function setDbh(DatabaseInterface $dbh)
    {
        $this->dbh = $dbh;
    }
    
    public function setRoute(Route $route)
    {
        $this->route = $route;
    }

}