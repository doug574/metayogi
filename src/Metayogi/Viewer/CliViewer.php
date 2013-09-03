<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Viewer;

use Metayogi\Foundation\Application;

/**
 * Builds html pages
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class CliViewer extends BaseViewer implements ViewerInterface
{

    /**
     * {@inheritdoc}
     */
    public function build()
    {
        $this->regions['content'] = array();
    }
    
    /**
     * {@inheritdoc}
     */
    public function render()
    {
        return "ok";
    }
}
