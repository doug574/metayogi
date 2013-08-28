<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Form;

use Metayogi\Database\DatabaseInterface;
use Metayogi\Routing\Router;
use Metayogi\Foundation\Registry;
use Metayogi\Viewer\ViewerInterface;


interface WidgetInterface
{
    public function __construct(DatabaseInterface $dbh, Router $router, Registry $registry, ViewerInterface $viewer, $data);
    public function build($properties);
    public function render();
}