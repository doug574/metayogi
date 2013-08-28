<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Foundation;

use Metayogi\Foundation\ObjectWrapper;
use Metayogi\Foundation\Application;
use Metayogi\Event\ApplicationEvent;

 
/**
 * Class for generating a response based on a client request
 *
 * @package Metayogi;
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class Controller
{
    protected $mediator;
    protected $router;
    protected $data;
    protected $event;
    protected $action;
    protected $display;
    
    public function __construct(Application $app)
    {
        $this->mediator = $app['mediator'];
        $this->router = $app['router'];
        $this->event = new ApplicationEvent($app);
    }

    public function addListeners()
    {
        $listeners = $this->router->getRoute('controller.listeners');
        $action = $this->router->getRoute('action');
        if (! empty ($listeners[$action])) {
#        print "ok";
            foreach ($listeners[$action] as $eventName => $list) {
                foreach ($list as $listenerName) {
#                print "<p>" . $action . "::" . $eventName . "::" . $listenerName . "</p>\n";
                $listener = new $listenerName();
                $this->mediator->addListener($eventName, array($listener, 'run'));
                }
            }
        }
#        print_r($listeners);
#        exit;
    }
}