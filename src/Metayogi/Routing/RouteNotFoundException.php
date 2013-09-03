<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Routing;

use Metayogi\Exception\ExceptionInterface;

/**
 * Route not found exception. Allows us to return 404 responses.
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class RouteNotFoundException extends \RuntimeException implements ExceptionInterface
{
}
