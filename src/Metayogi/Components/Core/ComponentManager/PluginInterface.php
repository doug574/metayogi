<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Metayogi\Components\Core\ComponentManager;
 
/**
 * Description
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
interface PluginInterface
{
    /**
     * Description
     *
     * @return array
     * @access public
     */
    public static function info();

    /**
     * Description
     *
     * @param object $controller Description
     *
     * @return void
     * @access public
     */
    public static function install($controller);

    /**
     * Description
     *
     * @param object $controller Description
     *
     * @return void
     * @access public
     */
    public static function uninstall($controller);
}

