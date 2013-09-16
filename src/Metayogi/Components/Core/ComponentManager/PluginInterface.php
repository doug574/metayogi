<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Metayogi\Components\Core\ComponentManager;

use Metayogi\Database\DatabaseInterface;
use Metayogi\Foundation\Registry;
 
/**
 * Interface for Plugin classes
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
interface PluginInterface
{
    /**
     * Component metadata
     *
     * @access public
     * @return array
     */
    public static function info();

    /**
     * Install the component
     *
     * @access public
     * @param Metayogi\Database\DatabaseInterface $dbh
     * @param Metayogi\Foundation\Registry        $registry
     * @return void
     */
    public static function install(DatabaseInterface $dbh, Registry $registry);

    /**
     * Uninstall the component
     *
     * @access public
     * @param Metayogi\Database\DatabaseInterface $dbh
     * @param Metayogi\Foundation\Registry        $registry
     * @return void
     */
    public static function uninstall(DatabaseInterface $dbh, Registry $registry);
}

