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
        $registry->set('behaviours.Trash', array());

        /* Actions */
        $registry->set('actions.EmptyAction', array (
            'namespace' => '\\Metayogi\\Components\\Optional\\Trash\\',
            'label' => 'Empty',
            'verb' => 'empty'
        ));
        $registry->set('actions.PurgeAction', array (
            'namespace' => '\\Metayogi\\Components\\Optional\\Trash\\',
            'label' => 'Purge',
            'verb' => 'purge',
            'params' => array (
                'id' => '*',
                ),
            )
        );
        $registry->set('actions.RecoverAction', array (
            'namespace' => '\\Metayogi\\Components\\Optional\\Trash\\',
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
     * @param object $app          description
     * @param string $controllerID desc
     *
     * @return void
     * @access public
     */
    public static function enable($app, $controllerID)
    {
       $app->dbh->push('my:controllers', $controllerID, 'hooks.myDeleteAction.pre', 'myTrashDeleteHook');
    }

    /**
     * Description
     *
     * @param object $app          description
     * @param string $controllerID desc
     *
     * @return void
     * @access public
     */
    public static function disable($app, $controllerID)
    {
       $app->dbh->pull('my:controllers', $controllerID, 'hooks.myDeleteAction.pre', 'myTrashDeleteHook');
    }

}
