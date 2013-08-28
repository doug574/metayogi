<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Event;

/**
 * desc
 *
 * @package Metayoyi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
final class ApplicationEvents
{
    const APP_BOOT = 'app.boot';
    const APP_SHUTDOWN = 'app.shutdown';
    const APP_EXCEPTION = 'app.exception';
} 