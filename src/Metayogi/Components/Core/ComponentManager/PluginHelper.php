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
class PluginHelper
{
    /**
     * Description
     *
     * @param object $dbh       Description
     * @param array  $datafiles Desc
     * @param string $dir       Desc
     *
     * @return void
     * @access public
     */
    public static function addData($dbh, $datafiles, $dir)
    {
        foreach ($datafiles as $collection) {
            $filename = $collection . ".json";
            list($namespace, $data) = explode(":", $collection);
            $json = json_decode(file_get_contents($dir . "/$filename"), true);
            $dbh->batchInsert($collection, $json);
        }
    }

    /**
     * Description
     *
     * @param object $dbh   Description
     * @param array  $datafiles Desc
     * @param string $dir       Desc
     *
     * @return void
     * @access public
     */
    public static function removeData($dbh, $datafiles, $dir)
    {
        foreach ($datafiles as $collection) {
            $filename = $collection . ".json";
            list($namespace, $data) = explode(":", $collection);
            $json = json_decode(file_get_contents($dir . "/$filename"), true);
            foreach ($json as $item) {
                if (! empty($item['_id'])) {
                    $dbh->remove($collection, $item['_id']);
                }
            }
        }
    }
}
