<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Display;

use Metayogi\Database\DatabaseInterface;
use Metayogi\Routing\Router;
use Metayogi\Foundation\Registry;
use Metayogi\Viewer\ViewerInterface;

/**
 * Defines the Display interface
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
interface DisplayInterface
{
    /**
     * Constructor
     *
     * @return object
     * @access public
     */
    public function __construct(DatabaseInterface $dbh, Router $router, Registry $registry, ViewerInterface $viewer, $data);

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
