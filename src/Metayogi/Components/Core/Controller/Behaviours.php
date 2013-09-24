<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Components\Core\Controller;

use Metayogi\Event\ApplicationEvent;
use Metayogi\Foundation\Kernel;

/**
 * desc
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class Behaviours
{
    protected $dbh;
    protected $router;
    protected $registry;
    protected $data;
    
    public function __construct($dbh, $router, $registry, $data)
    {
        $this->dbh = $dbh;
        $this->router = $router;
        $this->registry = $registry;
        $this->data = $data->getStore();
    }

    public function update()
    {

    }
}