<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Event;

use Symfony\Component\EventDispatcher\Event;
use Metayogi\Foundation\Application;


/**
 * Desc
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class ApplicationEvent extends Event
{
    protected $dbh;
    protected $router;
    
    public function __construct($app)
    {
        $this->dbh = $app['dbh'];
        $this->router = $app['router'];
    }
    
    public function getDbh()
    {
        return $this->dbh;
    }
}