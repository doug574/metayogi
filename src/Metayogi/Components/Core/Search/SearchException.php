<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Components\Core\Search;

use Metayogi\Exception\ExceptionInterface;

/**
 * Database load exception.
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class SearchException extends \RuntimeException implements ExceptionInterface
{
}