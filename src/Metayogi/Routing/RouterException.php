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
 * Router exception.
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class RouterException extends \RuntimeException implements ExceptionInterface
{
}
