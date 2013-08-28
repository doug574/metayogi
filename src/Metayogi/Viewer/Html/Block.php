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

/**
 * Builds html pages
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class Block extends \Pimple
{
    protected $display;

    public function __construct(Application $app)
    {
        $this['config'] = $app['config'];
        $this['dbh'] = $app['dbh'];
        $this['logger'] = $app['logger'];
        $this['exception_handler'] = $app['exception_handler'];
        $this['registry'] = $app['registry'];
        $this['router'] = $this->share(function ($this) {
            return new $this['config']['router']['class']($this['dbh'], $this['registry']);
        });
        $this['viewer'] = $app['viewer'];
    }

    /**
     * Description
     *
     * @param string $block Description
     *
     * @return void
     * @access public
     */
    public function build($block)
    {
#        try {
#            $block = $this['dbh']->load(Kernel::BLOCKS_COLLECTION, $blockID);
#        } catch (\Exception $e) {
#            print $e->getMessage();
#        }
        
        $this['request'] = Request::create(
                $block['route'],
                'GET',
                array()
            );

        $this['router']->findRoute($this['request']);
        
        /* Action */
        $actionName = $this['router']->getRoute('action');
        $action = new $actionName($this['dbh'], $this['router'], $this['registry']);
        $this['data'] = $action->run();

        /* View */
        $displayName = $this['router']->getRoute('view.display');
        $this->display = new $displayName($this['dbh'], $this['router'], $this['registry'], $this['viewer'], $this['data']);
        $this->display->build();

    }
    
    /**
     * description
     *
     * @return string
     * @access public
     */
    public function render()
    {
        return $this->display->render();
    }
}
