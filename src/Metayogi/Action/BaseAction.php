<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Action;

use Metayogi\Database\DatabaseInterface;
use Metayogi\Routing\Router;
use Metayogi\Foundation\Registry;
 
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
    protected $router;
    protected $registry;
    protected $data;
    
    /**
     * Description
     *
     * @return void
     */
    public function __construct(DatabaseInterface $dbh, Router $router, Registry $registry)
    {
        $this->dbh = $dbh;
        $this->router = $router;
        $this->registry = $registry;
    }

}