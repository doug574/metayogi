<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Metayogi\Database;

/**
 * Database abstraction layer for MongoDB.
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class MongoDatabase implements DatabaseInterface
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
            $mongo = new \Mongo('mongodb://' . $dbuser . '@' . $host . ':' . $port . '/'  . $dbname);
        } else {
            $mongo = new \Mongo('mongodb://' . $host . ':' . $port . '/'  . $dbname);
        }
        $this->dbo = $mongo->selectDB($dbname);
    }
    
    /**
     * Insert a single record into a collection
     *
     * @param string $collectionName Description
     * @param array  $data           Description
     *
     * @return void
     * @access public
     */
    public function insert($collectionName, $data)
    {
        if (isset($data['_id']) && is_string($data['_id'])) {
            $data['_id'] = new MongoID($data['_id']);
        }
        $collection = $this->dbo->selectCollection($collectionName);
        $result = $collection->insert($data, array('safe' => true));
        if (is_array($result) && (! is_null($result['err']))) {
            throw new DatabaseInsertException('Insert failed');
        }
    }


    /**
     * Fetch one record from a collection
     *
     * @param string $collectionName Description
     * @param string $recordID       Description
	 * @param array  $embed          References to be embedded
     *
     * @return array
     * @access public
     */
    public function load($collectionName, $recordID, $embed = array())
    {
        if (is_array($recordID)) {
            $query = $recordID;
        } else {
            $query = array('_id'=> new MongoId($recordID));
        }

        /* Check if this collection uses embedding/caching */
        if (! empty($embed[$collectionName])) {
            return $this->cache($collectionName, $recordID, $embed);
        }
        
        $collection = $this->dbo->selectCollection($collectionName);
        $doc = $collection->findone($query);
        if ($doc == null) {
            throw new DatabaseLoadException("$collectionName  $recordID Load failed");
        }

        /* Dont want MongoIDs in the doc returned */
        $doc['_id'] = (string) $doc['_id'];

        return $doc;
    }

}
