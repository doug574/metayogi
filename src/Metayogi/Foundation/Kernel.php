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
    const ROUTE_COLLECTION = "my:routes";
    const RBAC_COLLECTION = "my:rbacs";
    const REGISTRY_COLLECTION = "my:registry";
    const BLOCK_COLLECTION = 'my:blocks';
    const CONTROLLER_COLLECTION = 'my:controllers';
    const VIEW_COLLECTION = 'my:views';
    const FIELDSET_COLLECTION = 'my:fieldsets';
    const COMPONENT_COLLECTION = 'my:components';
    const LAYOUT_COLLECTION = 'my:layouts';
    const REGION_COLLECTION = 'my:regions';
    const THEME_COLLECTION = 'my:themes';
    const MODEL_COLLECTION = 'rdfs:classes';
    const PROPERTY_COLLECTION = 'rdf:properties';
    const NAMESPACE_COLLECTION = 'my:namespaces';
    
    const REGISTRY_ROOT = '50575842f311fecd1b000000';
    const ADMIN_LAYOUT = '4eda94436c10ba3216000000';
    const PUBLIC_LAYOUT = '506be69e0de404f30d00001c';
    
    /*
    * Events
    */
    const APPLICATION_BOOT = 'application.boot';
    const VIEWER_INIT = 'viewer.init';
    const ACTION_PRE = 'action.pre';
    const FORM_VALID = 'form.valid';
    const FORM_RELOAD = 'form.reload';
    const ACTION_CANCEL = 'action.cancel';
    const ACTION_POST = 'action.post';
    const RECORD_HOOK = 'record.hook';
    const VIEWER_INJECT = 'viewer.inject';
    const APPLICATION_SHUTDOWN = 'application.shutdown';
    const APPLICATION_EXCEPTION = 'application.exception';
}
