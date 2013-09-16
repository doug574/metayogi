<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Action;

/**
 * Defines interface for our Action classes
 *
 * @package Metayogi;
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
interface ActionInterface
{
    /**
     * Constructor inherited by all actions. Makes global objects available to the action.
     *
     * @access public
     * @param object $app
     * @param object $event
     * @return void
     */
    public function __construct ($app, $event);

    /**
     * Completes the action, sets data result, dispataches the next event
     *
     * @access public
     * @return void
     */
    public function run();
}
