<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Form;

interface WidgetInterface
{
    public function __construct();
    public function build($app, $properties);
    public function render();
}