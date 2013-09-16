<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Components\Core\ComponentManager;

use Metayogi\Foundation\Kernel;
use Metayogi\Components\Core\ComponentManager\PluginInterface;
use Metayogi\Database\DatabaseInterface;
use Metayogi\Foundation\Registry;

/**
 * Class of static methods for installing/uninstalling this component.
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class ComponentManagerPlugin implements PluginInterface
{
    /** Entity ID for this component in the Components collection */
    protected static $uuid = '5070bb890de404f00d0000ce';

    /** Files of entities installed/uninstalled with this component */
    protected static $datafiles = array('my:routes', 'my:views', 'my:controllers' /*, 'my:rbacs'*/);

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
            'name' => 'ComponentManager',
            'label' => 'Component Manager',
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

        /* Add actions to registry */
        $registry->reload();
        $registry->set('actions.InstallAction', array (
            'namespace' => '\\Metayogi\\Components\\Core\\ComponentManager\\',
            'label'=>'Install',
            'verb' => 'enable',
            'callback' => 'Metayogi\\Components\\Core\\ComponentManager\\ComponentManagerPlugin::displayAction',
            'params' => array('id' => '*')
        ));
        $registry->set('actions.UninstallAction', array (
            'namespace' => '\\Metayogi\\Components\\Core\\ComponentManager\\',
            'label'=>'Uninstall',
            'verb' => 'disable',
            'callback' => 'Metayogi\\Components\\Core\\ComponentManager\\ComponentManagerPlugin::displayAction',
            'params' => array('id' => '*')
        ));
        $registry->set('actions.ConfigureAction', array (
            'namespace' => '\\Metayogi\\Components\\Core\\ComponentManager\\',
            'label'=>'Configure',
            'verb' => 'configure',
            'callback' => 'Metayogi\\Components\\Core\\ComponentManager\\ComponentManagerPlugin::displayAction',
            'params' => array('id' => '*')
        ));
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
     * Callback function for Display objects
     *
     * @param array $action Description
     * @param array $doc    Description
     *
     * @return array
     * @access public
     */
    public static function displayAction($action, $doc)
    {
        $params = array();
        if ($action['verb'] == 'enable' && $doc['enabled'] == '0') {
            $params['id'] = (string) $doc['_id'];
        }
        if ($action['verb'] == 'disable' && $doc['enabled'] == '1') { # && $doc['category'] != 'Core') {
            $params['id'] = (string) $doc['_id'];
        }
        if ($action['verb'] == 'configure' && isset($doc['configurable']) && $doc['configurable'] == '1') {
            $params['id'] = (string) $doc['_id'];
        }

        return $params;
    }

    public static function register($dbh, $registry)
    {
        /* Fetch list of registered components */
        $tmplist = $dbh->fetchAll(Kernel::COMPONENT_COLLECTION);
        $registered = array();
        if (! empty($tmplist)) {
            foreach ($tmplist as $component) {
                $registered[] = $component['name'];
            }
        }

        /* Find all components */
        $rit = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator(BASEPATH));
        $components = array();
        foreach ($rit as $name => $entry) {
            if ($entry->isFile()) {
                $plugin = basename($name, '.php');
                $needle = "Plugin";
                $expectedPosition = strlen($plugin) - strlen($needle);
                $found = strrpos($plugin, $needle, 0);
                if ($found === $expectedPosition && $plugin != 'myPlugin') {
                    $pos = strpos($name, 'Metayogi');
                    if ($pos !== false) {
                        $plugin = substr($name, $pos);
                        $plugin = '\\' . str_replace('/', '\\', $plugin);
                        $plugin = substr($plugin, 0, strlen($plugin) - 4);
                    }
                    $info = $plugin::info();
                    $info['enabled'] = '0';
                    if (! in_array($info['name'], $registered)) {
                        $info['rdf:type'] = Kernel::COMPONENT_COLLECTION;
                        $components[] = $info;
                    }
                }
            }
        }
        $rit = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator(APP_PATH));
        foreach ($rit as $name => $entry) {
            if ($entry->isFile()) {
                $plugin = basename($name, '.php');
                $needle = "Plugin";
                $expectedPosition = strlen($plugin) - strlen($needle);
                $found = strrpos($plugin, $needle, 0);
                if ($found === $expectedPosition && $plugin != 'myPlugin') {
                    $info = $plugin::info();
                    $info['enabled'] = '0';
                    if (! in_array($info['name'], $registered)) {
                        $info['rdf:type'] = Kernel::COMPONENT_COLLECTION;
                        $components[] = $info;
                    }
                }
            }
        }
        if (! empty($components)) {
            $dbh->batchInsert(Kernel::COMPONENT_COLLECTION, $components);
        }

    }
}
