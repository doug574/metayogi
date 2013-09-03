<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Viewer\Html;

use Metayogi\Foundation\Application;
use Metayogi\Foundation\Kernel;
use Symfony\Component\HttpFoundation\Request;
use Metayogi\Event\ApplicationEvent;

/**
 * Builds an html block
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class Block extends \Pimple
{
    /**
    * Display object for this block
    * @var Metayogi\Display\DisplayInterface
    */
    protected $display;

    /**
     * Makes global services available via DI container
     *
     * @param Metayogi\Foundation\Application $app
     * @access public
     * @return void
     */
    public function __construct(Application $app)
    {
        $this['config'] = $app['config'];
        $this['dbh'] = $app['dbh'];
        $this['logger'] = $app['logger'];
        $this['registry'] = $app['registry'];
        $this['router'] = $this->share(function ($this) {
            return new $this['config']['router']['class']($this['dbh'], $this['registry']);
        });
        $this['viewer'] = $app['viewer'];
        $this['mediator'] = $app['mediator'];
    }

    /**
     * Creates the block with services from Application
     *
     * @access public
     * @param string $block
     * @return void
     */
    public function build($block)
    {        
        $this['request'] = Request::create(
                $block['route'],
                'GET',
                array()
            );

        $this['router']->findRoute($this['request']);

        $event = new ApplicationEvent($this);
        
        /* Action */
        $actionName = $this['router']->getRoute('action');
        $action = new $actionName($this['dbh'], $this['router'], $this['registry'], $this['viewer'], $this['request'], $this['mediator'], $event);
        $this['data'] = $action->run();

        /* View */
        $displayName = $this['router']->getRoute('view.display');
        $this->display = new $displayName($this['dbh'], $this['router'], $this['registry'], $this['viewer'], $this['data']);
        $this->display->build();

    }
    
    /**
     * Generate content
     *
     * @access public
     * @return string
     */
    public function render()
    {
        return $this->display->render();
    }
}
