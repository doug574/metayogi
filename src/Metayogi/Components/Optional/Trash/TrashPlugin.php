<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Components\Optional\Trash;

use Metayogi\Foundation\Kernel;
use Metayogi\Components\Core\ComponentManager\PluginInterface;
use Metayogi\Components\Core\ComponentManager\PluginHelper;
use Metayogi\Database\DatabaseInterface;
use Metayogi\Foundation\Registry;
use Metayogi\Routing\Router;

/**
 * Class of static methods for installing/uninstalling this component.
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class TrashPlugin implements PluginInterface
{
    /** Entity ID for this component in the Components collection */
    protected static $uuid = '5070bb890de404f00d0000d7';

    /** Files of entities installed/uninstalled with this component */
    protected static $datafiles = array('my:routes', 'my:views', 'my:controllers' /*, 'my:rbacs'*/);

    const TRASH_COLLECTION = "my:trash";
    
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
            'name' => 'Trash',
            'label' => 'Trash',
            'namespace' => __NAMESPACE__,
            'description' => 'Saves deleted entities to trash can',
            'requires' => array(),
            'category' => 'Optional',
            'behaviour' => 1,
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
        
        /* Behaviours */
        $registry->set('behaviours.Trash', array(
            'namespace' => '\\' . __NAMESPACE__ . '\\',
        ));

        /* Actions */
        $registry->set('actions.EmptyAction', array (
            'namespace' => '\\' . __NAMESPACE__ . '\\',
            'label' => 'Empty',
            'verb' => 'empty'
        ));
        $registry->set('actions.PurgeAction', array (
            'namespace' => '\\' . __NAMESPACE__ . '\\',
            'label' => 'Purge',
            'verb' => 'purge',
            'params' => array (
                'id' => '*',
                ),
            )
        );
        $registry->set('actions.RecoverAction', array (
            'namespace' => '\\' . __NAMESPACE__ . '\\',
            'label' => 'Recover',
            'verb' => 'recover',
            'params' => array (
                'id' => '*',
                ),
            )
        );

        $registry->save();
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
    }
    
    /**
     * Description
     *
     * @access public
     * @param Metayogi\Database\DatabaseInterface $dbh
     * @param Metayogi\Foundation\Registry        $registry
     * @param use Metayogi\Routing\Router         $router
     * @return void
     */
    public static function enable(DatabaseInterface $dbh, Registry $registry, Router $router)
    {
        $instance = $router->getInstance();
        $controllerID = (string) $instance['_id'];
        $dbh->push('my:controllers', $controllerID, 'listeners.\\Metayogi\\Action\\DeleteAction', array (
            'event' => 'action.pre',
            'listener' => '\\Metayogi\\Components\\Optional\\Trash\\TrashListener',
            'method' => 'onDelete',
        ));
        $dbh->set('my:controllers', $controllerID, 'behaviours.Trash', 1);
    }

    /**
     * Description
     *
     * @access public
     * @param Metayogi\Database\DatabaseInterface $dbh
     * @param Metayogi\Foundation\Registry        $registry
     * @param use Metayogi\Routing\Router         $router
     * @return void
     */
    public static function disable(DatabaseInterface $dbh, Registry $registry, Router $router)
    {
        $instance = $router->getInstance();
        $controllerID = (string) $instance['_id'];
        $dbh->pull('my:controllers', $controllerID, 'listeners.\\Metayogi\\Action\\DeleteAction', array (
            'event' => 'action.pre',
            'listener' => '\\Metayogi\\Components\\Optional\\Trash\\TrashListener',
            'method' => 'onDelete',
        ));
        $dbh->set('my:controllers', $controllerID, 'behaviours.Trash', 0);
    }

}
