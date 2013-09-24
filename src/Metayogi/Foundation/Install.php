<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Foundation;

use \Metayogi\Components\Core\ComponentManager\PluginHelper;
use \Metayogi\Components\Core\Menu\MenuPlugin;
use \Metayogi\Components\Core\ComponentManager\ComponentManagerPlugin;
use \Metayogi\Components\Core\ModelWizard\ModelWizardPlugin;
use \Metayogi\Components\Core\Cache\CachePlugin;
use \Metayogi\Components\Core\Relation\RelationPlugin;
use \Metayogi\Components\Core\ViewWizard\ViewWizardPlugin;
use \Metayogi\Components\Core\SearchWizard\SearchWizardPlugin;
use \Metayogi\Components\Core\User\UserPlugin;
use \Metayogi\Components\Core\Rbac\RbacPlugin;
use \Metayogi\Components\Core\Controller\ControllerPlugin;
use \Metayogi\Components\Core\Search\SearchPlugin;

/**
 * Class of static methods for installing application.
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class Install
{
    /** desc */
    protected static $datafiles = array('my:layouts', 'my:regions', 'my:blocks', 'my:themes');

    /**
     * Description
     *
     * @return void
     * @access public
     */
    public static function install($dbh, $registry)
    {
        
        /*
        * Remove collections
        */
        $dbh->dropCollections();

        /*
        * Collections for kernel
        */
        PluginHelper::addData($dbh, self::$datafiles, dirname(__FILE__) . '/data/');

        /*
        * Initialize registry
        */
        $registry->set('_id', Kernel::REGISTRY_ROOT);
        $registry->set('actions', array (
            'CreateAction' => array (
                'namespace' => '\\Metayogi\\Action\\',
                'label' => 'Add',
                'verb' => 'add',
            ),
            'DeleteAction' => array (
                'namespace' => '\\Metayogi\\Action\\',
                'label' => 'Delete',
                'verb' => 'delete',
                'params' => array (
                    'id' => '*',
                ),
            ),
            'EditAction' => array (
                'namespace' => '\\Metayogi\\Action\\',
                'label' => 'Update',
                'verb' => 'update',
                'params' => array (
                    'id' => '*',
                ),
            ),
            'ListAction' => array (
                'namespace' => '\\Metayogi\\Action\\',
                'label' => 'Show',
                'verb' => '',
                'params' => array (
                    'pagesize' => '10',
                    'pagenum' => '0',
                ),
            ),
            'LoadAction' => array (
                'namespace' => '\\Metayogi\\Action\\',
                'label' => 'Display',
                'verb' => 'display',
                'params' => array (
                    'id' => '*',
                ),
            ),
        ));
        $registry->set('behaviours', array (
        ));
        $registry->set('cache', array (
            'my:layouts' => array (
                'theme' => 'r',
                'regions' => 'r',
            ),
            'my:regions' => array (
                'blocks' => 'o',
            ),
            'my:routes' => array (
                'layout' => 'o',
                'view' => 'o',
                'model' => 'o',
                'controller' => 'r',
            ),
            'my:views' => array (
                'TableDisplay.fieldset' => 'o',
                'RecordDisplay.fieldset' => 'o',
                'FormDisplay.elementset' => 'o',
            ),
        ));
        $registry->set('components', array (
        ));
        $registry->set('displays', array (
            'FormDisplay' => array(),
            'TableDisplay' => array(),
            'ListDisplay' => array(),
            'RecordDisplay' => array(),
        ));
        $registry->set('decorators', array (
            'TitleDecorator' => array()
        ));
        $registry->set('gadgets', array (
            'StringField' => array('namespace' => '\\Metayogi\\Field\\'),
            'TextField' => array('namespace' => '\\Metayogi\\Field\\'),
            'BooleanField' => array('namespace' => '\\Metayogi\\Field\\'),
            'DateField' => array('namespace' => '\\Metayogi\\Field\\'),
            'DatetimeField' => array('namespace' => '\\Metayogi\\Field\\'),
            'OperationsField' => array('namespace' => '\\Metayogi\\Field\\'),
            
        ));
        $registry->set('widgets', array (
            'ButtonElement' => array('namespace' => '\\Metayogi\\Form\\Element\\'),
            'InputElement' => array('namespace' => '\\Metayogi\\Form\\Element\\'),
            'CheckBoxElement' => array('namespace' => '\\Metayogi\\Form\\Element\\'),
            'RadioElement' => array('namespace' => '\\Metayogi\\Form\\Element\\'),
            'SelectElement' => array('namespace' => '\\Metayogi\\Form\\Element\\'),
            'TextAreaElement' => array('namespace' => '\\Metayogi\\Form\\Element\\'),
        ));
        $dbh->insert(Kernel::REGISTRY_COLLECTION, $registry->getStore());
        
        /*
        * Find components
        */
        ComponentManagerPlugin::register($dbh, $registry);
        
        /*
        * Install core components
        */
        MenuPlugin::Install($dbh, $registry);
        ComponentManagerPlugin::Install($dbh, $registry);
        ModelWizardPlugin::Install($dbh, $registry);
        CachePlugin::Install($dbh, $registry);
        RelationPlugin::Install($dbh, $registry);
        ViewWizardPlugin::Install($dbh, $registry);
        SearchWizardPlugin::Install($dbh, $registry);
        UserPlugin::Install($dbh, $registry);
        RbacPlugin::Install($dbh, $registry);
        ControllerPlugin::Install($dbh, $registry);
        SearchPlugin::Install($dbh, $registry);
    }
}