<?php
/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Database;

/**
 * Defines interface for database abstraction layer.
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
interface DatabaseInterface
{
    /**
     * Description
     *
     * @param array $config Description
     *
     * @return object
     * @access public
     */
    public function __construct($config);

    public function insert($collectionName, $data);
    
    public function query($collectionName, $query = array(), $attrs = array());
    
    public function createID();
}
