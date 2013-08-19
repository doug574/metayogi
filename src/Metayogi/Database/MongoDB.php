<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

/**
 * Database abstraction layer for MongoDB.
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class MongoDB implements DatabaseInterface
{
    /** description */
    protected $dbo;

    /**
     * Establishes the database connection
     * Throws MongoException on error
     *
     * @param array $config Description
     *
     * @return void
     * @access public
     */
    public function __construct($config)
    {
        extract($config);
        if (! empty($dbuser)) {
            $mongo = new Mongo('mongodb://' . $dbuser . '@' . $host . ':' . $port . DS  . $dbname);
        } else {
            $mongo = new Mongo('mongodb://' . $host . ':' . $port . DS  . $dbname);
        }
        $this->dbo = $mongo->selectDB($dbname);
    }
}
