<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Viewer;
 
/**
 * Builds html pages
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class JsonViewer extends BaseViewer implements ViewerInterface
{
    public function __construct(Application $app)
    {
        parent::__construct($app);
    }

    /**
     * description
     *
     * @param Metayogi\Foundation\Application $app Description
     *
     * @return void
     * @access public
     */
    public function build(Application $app)
    {
        $app['response']->headers->set('Content-Type', 'application/json');
    }

    /**
     * description
     *
     * @return string
     * @access public
     */
    public function render()
    {
        return json_encode($this->data);
    }
    
}
