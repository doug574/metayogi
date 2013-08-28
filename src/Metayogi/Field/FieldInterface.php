<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Field;

use Metayogi\Database\DatabaseInterface;
use Metayogi\Routing\Router;
use Metayogi\Foundation\Registry;

/**
 * Defines the Field interface
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
interface FieldInterface
{
    public function __construct(DatabaseInterface $dbh, Router $router, Registry $registry);
    public function build($properties, $doc);
    public function render();
}
