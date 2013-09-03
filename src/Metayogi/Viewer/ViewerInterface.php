<?php

/**
 *
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
*/

namespace Metayogi\Viewer;

use Metayogi\Foundation\Application;

/**
 * Defines interface for viewer classes
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
interface ViewerInterface
{
    /**
     * Makes global services available via DI container
     *
     * @param Metayogi\Foundation\Application $app
     * @access public
     * @return void
     */
    public function __construct(Application $app);

    /**
     * Initialize response content
     *
     * @access public
     * @return void
     */
    public function build();

    /**
     * Generate content for Response
     *
     * @access public
     * @return mixed
     */
    public function render();
}
