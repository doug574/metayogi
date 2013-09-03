<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Foundation;

/**
 * Defines interface for database abstraction layer.
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
final class Kernel
{
    const ROUTES_COLLECTION = "my:routes";
    const REGISTRY_COLLECTION = "my:registry";
    const BLOCKS_COLLECTION = 'my:blocks';
    
    const REGISTRY_ROOT = '50575842f311fecd1b000000';
    
    /*
    * Events
    */
    const APPLICATION_BOOT = 'application.boot';
    const VIEWER_INIT = 'viewer.init';
    const ACTION_PRE = 'action.pre';
    const ACTION_CANCEL = 'action.cancel';
    const ACTION_POST = 'action.post';
    const VIEWER_INJECT = 'viewer.inject';
    const APPLICATION_SHUTDOWN = 'application.shutdown';
    const APPLICATION_EXCEPTION = 'application.exception';
}
