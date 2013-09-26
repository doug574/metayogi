<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Components\Core\Controller;

use Metayogi\Foundation\Kernel;
use Metayogi\Components\Core\ComponentManager\PluginInterface;
use Metayogi\Components\Core\ComponentManager\PluginHelper;
use Metayogi\Database\DatabaseInterface;
use Metayogi\Foundation\Registry;

/**
 * Description
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class ControllerPlugin implements PluginInterface
{
    /** Entity ID for this component in the Components collection */
    protected static $uuid = '50f8e0e4f311fe013f000093';

    /** Files of entities installed/uninstalled with this component */
    public static $datafiles = array ('my:routes', 'my:views', 'my:controllers');

    /**
     * Component metadata
     *
     * @access public
     * @return void
     */
    public static function info()
    {
        return array(
            '_id' => self::$uuid,
            'name' => 'Controller',
            'label' => 'Controller',
            'namespace' => __NAMESPACE__,
            'description' => '',
            'requires' => array(),
            'category' => 'Core',
            );
    }

    /**
     * Install this component
     *
     * @access public
     * @param Metayogi\Database\DatabaseInterface $dbh
     * @param Metayogi\Foundation\Registry        $registry
     * @return void
     */
    public static function install(DatabaseInterface $dbh, Registry $registry)
    {
        PluginHelper::addData($dbh, self::$datafiles, dirname(__FILE__) . '/data/');
        $dbh->set(Kernel::COMPONENT_COLLECTION, self::$uuid, 'enabled', '1');
        
        $registry->reload();
        $registry->set('actions.ToggleAction', array (
            'namespace' => '\\Metayogi\\Components\\Core\\Controller\\',
            'label' => 'Toggle',
            'verb' => 'toggle',
            'params' => array (
                'id' => '*',
                'bid' => '*',
                ),
            )
        );
        $registry->save();

#        $app->dbh->push(myKernelPlugin::MENUS_COLLECTION, myKernelPlugin::ADMIN_MENU, 'menuitems.4debug.menuitems', array(
#           'method' => 'link',
#            'menuitemtitle' => 'Controllers',
#            'menuitempath' => 'admin/controllers'
#        ));
    }

    /**
     * Uninstall this component
     *
     * @access public
     * @param Metayogi\Database\DatabaseInterface $dbh
     * @param Metayogi\Foundation\Registry        $registry
     * @return void
     */
    public static function uninstall(DatabaseInterface $dbh, Registry $registry)
    {
        PluginHelper::removeData($dbh, self::$datafiles, dirname(__FILE__) . '/data/');
        $dbh->set(Kernel::COMPONENT_COLLECTION, self::$uuid, 'enabled', '0');
#        $app->dbh->pull(myKernelPlugin::MENUS_COLLECTION, myKernelPlugin::ADMIN_MENU, 'menuitems.4debug.menuitems', array(
#           'method' => 'link',
#            'menuitemtitle' => 'Controllers',
#            'menuitempath' => 'admin/controllers'
#        ));
    }
}
