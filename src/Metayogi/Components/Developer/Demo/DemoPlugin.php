<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Components\Developer\Demo;

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
class DemoPlugin implements PluginInterface
{
    /** Entity ID for this component in the Components collection */
    protected static $uuid = '5240a3d8f311fe04199b063e';

    /** Files of entities installed/uninstalled with this component */
    protected static $datafiles = array('my:namespaces', 'rdf:properties', 'rdfs:classes', 'my:routes', 'my:views', 'my:controllers', 'my:fieldsets', 'my:indexes', 'my:sforms', 'ssu:work' /*, 'my:rbacs'*/);

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
            'name' => 'Demo',
            'label' => 'Demo',
            'namespace' => __NAMESPACE__,
            'description' => '',
            'requires' => array(),
            'category' => 'Developer',
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

        $dbh->push('my:menus', '50080fcef311fef627000002', 'menuitems.1collect.menuitems', array(
            'method' => 'link',
            'menuitemtitle' => 'Works',
            'menuitempath' => 'admin/work'
        ));
        $dbh->set('my:menus', '50080fcef311fef627000002', 'menuitems.5search', array(
            'method' => 'dropdown',
            'menuitemtitle' => 'Search',
            'menuitems' => array (
                0 => array (
                    'method' => 'link',
                    'menuitemtitle' => 'Basic',
                    'menuitempath' => 'admin/works/search'
                ),
                1 => array (
                    'method' => 'link',
                    'menuitemtitle' => 'Advanced',
                    'menuitempath' =>  'admin/works/advanced'
                ),
            ),
        ));

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
