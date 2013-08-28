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
 * Defines interface for all actions
 *
 * @package Metayogi;
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
interface ActionInterface
{
    /**
     * Constructor
     *
     * @return object
     * @access public
     */
    public function __construct(DatabaseInterface $dbh, Router $router, Registry $registry);

    /**
     * Description
     *
     * @return void
     * @access public
     */
    public function run();
}
