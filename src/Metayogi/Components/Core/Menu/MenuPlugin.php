<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Components\Core\Menu;

use Metayogi\Foundation\Kernel;
use Metayogi\Components\Core\ComponentManager\PluginInterface;

/**
 * Class of static methods for installing/uninstalling this component.
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class MenuPlugin implements PluginInterface
{
    /** Entity ID for this component in the Components collection */
    protected static $uuid = '5070bb890de404f00d0000d2';

    /** Files of entities installed/uninstalled with this component */
    protected static $datafiles = array(/*'my:routes', 'my:views', 'my:controllers', 'my:rbacs'*/);

    /**
     * Description
     *
     * @return void
     * @access public
     */
    public static function info()
    {
        return array(
            '_id' => self::$uuid,
            'name' => 'Menu',
            'label' => 'Menu',
            'namespace' => __NAMESPACE__,
            'description' => '',
            'requires' => array(),
            'category' => 'Core',
            );
    }

    /**
     * Description
     *
     * @param object $app Description
     *
     * @return void
     * @access public
     */
    public static function install($dbh)
    {
        PluginHelper::addData($dbh, self::$datafiles, dirname(__FILE__) . '/data/');
        $dbh->set(Kernel::COMPONENTS_COLLECTION, self::$uuid, 'enabled', '1');
    }
    
    /**
     * Description
     *
     * @param object $app Description
     *
     * @return void
     * @access public
     */
    public static function uninstall($dbh)
    {
        PluginHelper::removeData($dbh, self::$datafiles, dirname(__FILE__) . '/data/');
        $dbh->set(Kernel::COMPONENTS_COLLECTION, self::$uuid, 'enabled', '0');
    }
}
