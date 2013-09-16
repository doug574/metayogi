<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Components\Optional\Analytics;

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
class AnalyticsPlugin implements PluginInterface
{
    /** Entity ID for this component in the Components collection */
    protected static $uuid = '520abaaef311feea4b3bc0cb';

    /** Files of entities installed/uninstalled with this component */
    protected static $datafiles = array(/*'my:routes', 'my:views', 'my:controllers', 'my:rbacs'*/);

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
            'name' => 'Analytics',
            'label' => 'Google Analytics',
            'namespace' => __NAMESPACE__,
            'description' => 'Adds Google Analytics to site',
            'requires' => array(),
            'category' => 'Optional',
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
}
