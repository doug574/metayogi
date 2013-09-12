<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Listener;

use Metayogi\Event\ApplicationEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Handles redirect events
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class RedirectListener
{
    /**
    * Generates redirect response for actions not needing display
    *
    * @access public
    * @param Metayogi\Event\ApplicationEvent $event
    * @return void
    */
    public function run(ApplicationEvent $event)
    {
        // TODO; fix with a referring url from session store (not server - page reloads)
        $router = $event->getRouter();
        $response = new RedirectResponse('/' . $router->get('controller.CRUDpath'));
        $response->send();
        exit;
    }
}
