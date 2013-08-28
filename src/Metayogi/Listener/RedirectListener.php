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
 * desc
 *
 * @package Metayogi;
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class RedirectListener
{
    public function run(ApplicationEvent $event)
    {
        $response = new RedirectResponse('http://www.usask.ca');
        $response->send();
        exit;
    }
}

