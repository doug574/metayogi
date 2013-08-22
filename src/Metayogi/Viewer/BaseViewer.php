<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Viewer;

use Metayogi\Routing\Route;
 
/**
 * Builds html pages
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
abstract class BaseViewer
{
    protected $route;
 
    /**
     * Description
     *
     * @return void
     */
    public function __construct()
    {
    }
 
    public function setRoute(Route $route)
    {
        $this->route = $route;
    }
}
