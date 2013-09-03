<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Viewer;
 
/**
 * Builds JSON response content
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class JsonViewer extends BaseViewer implements ViewerInterface
{
    /**
     * Set response header
     *
     * @return void
     * @access public
     */
    public function build()
    {
        $this->response->headers->set('Content-Type', 'application/json');
    }

    /**
     * Generate response content
     *
     * @return string
     * @access public
     */
    public function render()
    {
        return json_encode($this->data);
    }
}
