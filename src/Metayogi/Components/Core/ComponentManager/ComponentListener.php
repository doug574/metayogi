<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Components\Core\ComponentManager;

use Metayogi\Event\ApplicationEvent;
use Metayogi\Foundation\Kernel;

/**
 * 
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class ComponentListener
{
    /**
    * Generates redirect response for actions not needing display
    *
    * @access public
    * @param Metayogi\Event\ApplicationEvent $event
    * @return void
    */
    public function run(ApplicationEvent $event)
    {
        $dbh = $event->getDbh();
    
        /* Fetch list of registered components */
        $tmplist = $dbh->fetchAll(Kernel::COMPONENTS_COLLECTION);
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
                        $components[] = $info;
                    }
                }
            }
        }
        if (! empty($components)) {
            $dbh->batchInsert(Kernel::COMPONENTS_COLLECTION, $components);
        }

    }
}
