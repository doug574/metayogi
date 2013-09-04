<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Components\Core\Cache;

use Metayogi\Foundation\Kernel;
use Metayogi\Components\Core\ComponentManager\PluginInterface;

/**
 * Class of static methods for installing/uninstalling this component.
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class CachePlugin implements PluginInterface
{
    /** Entity ID for this component in the Components collection */
    protected static $uuid = '5070bb890de404f00d0000d6';

    /** Files of entities installed/uninstalled with this componnt */
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
            'name' => 'Cache',
            'label' => 'Cache',
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
    }
}
