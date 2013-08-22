<?php

/**
 *
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
*/

namespace Metayogi\Viewer;

use Metayogi\Routing\Route;

/**
 * Defines interface for viewer
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
interface ViewerInterface
{
    public function setRoute(Route $route);
}
