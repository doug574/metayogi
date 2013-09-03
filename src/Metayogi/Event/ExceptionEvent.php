<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * Desc
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class ExceptionEvent extends Event
{
    protected $exception;
    
    public function __construct($exception)
    {
        $this->exception = $exception;
    }

    public function getException()
    {
        return $this->exception;
    }
}
