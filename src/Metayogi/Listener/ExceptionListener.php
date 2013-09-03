<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Listener;

use Metayogi\Event\ExceptionEvent;
use Symfony\Component\HttpFoundation\Response;

/**
 * Handles exception events
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class ExceptionListener
{
    /**
    * Generate responses that terminate application
    *
    * @access public
    * @param Metayogi\Event\ExceptionEvent $event
    * @return void
    */
    public function onException(ExceptionEvent $event)
    {
        $exception = $event->getException();
        $code = $exception->getCode();

        if ($code == 404) {
            $response = new Response('Page not found', 404);
            $response->send();
            exit;
        }
            echo "<pre>";
            print get_class($exception);
            print $exception->getMessage();
            echo $exception->getTraceAsString();
            echo "</pre>";

        exit;
    }
}
