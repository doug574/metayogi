<?php
/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

/**
 * Defines interface for database abstraction layer.
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
interface myDatabaseInterface
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

}
