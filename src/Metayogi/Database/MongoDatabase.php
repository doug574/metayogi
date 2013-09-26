<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Metayogi\Database;

use Metayogi\Foundation\FlattenedArray;

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
            $data['_id'] = new \MongoID($data['_id']);
        }
        $collection = $this->dbo->selectCollection($collectionName);
        $result = $collection->insert($data, array('w' => 1));
        if (is_array($result) && (! is_null($result['err']))) {
            throw new DatabaseException('Insert failed');
        }
    }

    /**
     * Update a single record in a collection
     *
     * @param string $collectionName Description
     * @param array  $data           Description
     *
     * @return void
     * @access public
     */
    public function update($collectionName, $data)
    {
        if (! isset($data['_id'])) {
            throw new DatabaseException('Update missing _id');
        }
        $recordID = new \MongoID($data['_id']);
        unset($data['_id']);
        $collection = $this->dbo->selectCollection($collectionName);
        $result = $collection->update(array('_id' => $recordID), $data, array('w' => 1));

        if (is_array($result) && (! is_null($result['err']))) {
            throw new DatabaseException('Update failed');
        }
        if (is_array($result) && (! $result['updatedExisting'])) {
            throw new DatabaseException('Update failed');
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
        if ($recordID == null) {
            throw new DatabaseException("No record ID");
        }

        if (is_array($recordID)) {
            $query = $recordID;
        } else {
            $query = array('_id'=> new \MongoId($recordID));
        }

        /* Check if this collection uses embedding/caching */
        if (! empty($embed[$collectionName])) {
            return $this->cache($collectionName, $recordID, $embed);
        }

        $collection = $this->dbo->selectCollection($collectionName);
        $doc = $collection->findone($query);
        if ($doc == null) {
            throw new DatabaseException("$collectionName  $recordID Load failed");
        }

        /* Dont want MongoIDs in the doc returned */
        $doc['_id'] = (string) $doc['_id'];

        return $doc;
    }

    /**
     * Fetch one record from a collection
     *
     * @param string $collectionName Description
     * @param string $recordID       Description
     * @param array  $embed          References to be embedded
     *
     * @return array
     * @access protected
     */
    protected function cache($collectionName, $recordID, $embed)
    {
        if (is_array($recordID)) {
            $query = $recordID;
        } else {
            $query = array('_id'=> new \MongoId($recordID));
        }

        /* Lookup in cache */
        $collection = $this->dbo->selectCollection($collectionName . ".cache");
        $doc = $collection->findone($query);

        if ($doc == null) {

            $collection = $this->dbo->selectCollection($collectionName);
            $doc = $collection->findone($query);
            if ($doc == null) {
                throw new DatabaseException("$collectionName  Load failed");
            }

            $embedded = $embed[$collectionName];
            $doc['_embedded'] = array();
            $obj = new FlattenedArray($doc);
            foreach ($embedded as $key => $req) {
                        
                if ((! $obj->has($key)) && $req == 'r') {
                    throw new DatabaseException("$collectionName  Missing $key");
                }

                if (! $obj->has($key)) {
                    continue;
                }
                if ((! $obj->has("$key._id")) && (! $obj->has("$key._ref"))) {
                    continue;
                }

                if ((! $obj->has("$key._id")) || (! $obj->has("$key._ref"))) {
                    throw new DatabaseException("Bad relation");
                }

                $_id = $obj->get("$key._id");
                $_ref = $obj->get("$key._ref");
                
                /* Single ref */
                if (! is_array($_id)) {
                    if (! empty($embed[$_ref])) {
                        $obj->set($key, $this->cache($_ref, $_id, $embed));
                    } else {
                        $obj->set($key, $this->load($_ref, $_id));
                    }
                    $obj->push('_embedded', $_id);

                } else {
                    /* Multiple ref */
                    $obj->set($key, array());
                    foreach ($_id as $val) {
                        $obj->push('_embedded', $val);
                        if (! empty($embed[$_ref])) {
                            $subdoc = $this->cache($_ref, $val, $embed);
                        } else {
                            $subdoc = $this->load($_ref, $val);
                        }
                        if (! empty($subdoc['qname'])) {
                            $name = $subdoc['qname'];
                            $obj->set("$key.$name", $subdoc);
                        } elseif (! empty($subdoc['name'])) {
                            $name = $subdoc['name'];
                            $obj->set("$key.$name", $subdoc);
                        } else {
                            $obj->push($key, $subdoc);
                        }
                        if (! empty($subdoc['_embedded'])) {
                            $obj->set('_embedded', array_merge($obj->get('_embedded'), $subdoc['_embedded']));
                        }
                    }
                }
            }

            $doc = $obj->getStore();
            $collection = $this->dbo->selectCollection($collectionName . ".cache");
            $collection->insert($doc, array('w' => 1));

        }

        return $doc;
    }

    /**
     * Fetch multiple records from a collection
     *
     * @param string $collectionName Description
     * @param array  $query          desc
     * @param array  $attrs          desc
     *
     * @return array
     * @access public
     */
    public function query($collectionName, $query = array(), $attrs = array())
    {
        if (! isset($attrs['pagenum'])) {
            $attrs['pagenum'] = 0;
        }
        if (! isset($attrs['pagesize'])) {
            $attrs['pagesize'] = 100;
        }

        $results = $attrs;
        $collection = $this->dbo->selectCollection($collectionName);
        $cursor = empty($query) ? $collection->find() : $collection->find($query);

        $cursor->limit($attrs['pagesize']);
        $results['rows'] = $attrs['pagesize'];

        if (isset($attrs['sorts'])) {
            $cursor->sort($attrs['sorts']);
        }

        if ($attrs['pagenum']  > 0) {
            $cursor->skip($attrs['pagesize'] * $attrs['pagenum']);
        }

        $count = $cursor->count();
        $results['numFound'] = $count;
        if ($count == 0) {
            return $results;
        }

        foreach ($cursor as $doc) {
            $results['docs'][] = $doc;
        }

        return $results;
    }

    /**
     * Creates a new unqiue record ID
     *
     * @return string
     * @access public
     */
    public function createID()
    {
        $myID = new \MongoID();

        return (string) $myID;
    }

    /**
     * Delete single record from a collection
     *
     * @param string $collectionName Description
     * @param string $recordID       Description
     *
     * @return void
     * @access public
     */
    public function remove($collectionName, $recordID)
    {
        $collection = $this->dbo->selectCollection($collectionName);
        $result = $collection->remove(
            array('_id' => new \MongoId($recordID)),
            array("justOne" => true, 'w' => 1)
        );
        if (is_array($result) && (! is_null($result['err']))) {
            throw new DatabaseException('Insert failed');
        }
        if (is_array($result) && ($result['n'] != 1)) {
            throw new DatabaseException('Update failed');
        }
    }

    /**
     * desc
     *
     * @param string $collectionName Description
     *
     * @return array
     * @access public
     */
    public function fetchAll($collectionName)
    {
        $collection = $this->dbo->selectCollection($collectionName);
        $cursor = $collection->find();
        $array = iterator_to_array($cursor);

        return $array;
    }

    /**
     * Insert an array of records into a collection
     *
     * @param string $collectionName Description
     * @param array  $data           Description
     *
     * @return void
     * @access public
     */
     public function batchInsert($collectionName, $data)
    {
        if (empty($data)) {
            return;
        }

        if (isset($data[0]['_id'])) {
            $pos = 0;
            foreach ($data as $record) {
                $recordID = $record['_id'];
                $data[$pos]['_id'] = new \MongoId($recordID);
                $pos++;
            }
        }

        $collection = $this->dbo->selectCollection($collectionName);
        $result = $collection->batchInsert($data);
    }
    
    /**
     * Drop all collections in the db
     *
     * @return void
     * @access public
     */
    public function dropCollections()
    {
        $collections = $this->dbo->listCollections();
        foreach ($collections as $collection) {
            $collection->drop();
        }
    }

    /**
     * desc
     *
     * @param string $collectionName Description
     *
     * @return string
     * @access public
     */
    public function collectionDrop($collectionName)
    {
        $collection = $this->dbo->selectCollection($collectionName);
        $collection->drop();
    }
    
    /**
     * desc
     *
     * @param string $collectionName Description
     * @param string $recordID       Description
     * @param string $key            Description
     * @param mixed  $val            Description
     *
     * @return void
     * @access public
     */
    public function set($collectionName, $recordID, $key, $val)
    {
        $update = array('$set'=>array($key => $val));
        $collection = $this->dbo->selectCollection($collectionName);
        $collection->update(array('_id' => new \MongoId($recordID)), $update, array('w' => 1));
    }
    
    /**
     * desc
     *
     * @param string $collectionName Description
     *
     * @return int
     * @access public
     */
    public function count($collectionName)
    {
        $collection = $this->dbo->selectCollection($collectionName);

        return $collection->count();
    }

    /**
     * Truncate a collection
     *
     * @param string $collectionName Description
     *
     * @return void
     * @access public
     */
    public function truncate($collectionName)
    {
        $collection = $this->dbo->selectCollection($collectionName);
        $collection->remove(array(), array('w' => 1));

        $collection = $this->dbo->selectCollection($collectionName . ".cache");
        $collection->remove(array(), array('w' => 1));
    }

    /**
     * desc
     *
     * @param string $collectionName Description
     * @param string $recordID       Description
     * @param string $key            Description
     * @param mixed  $val            Description
     *
     * @return void
     * @access public
     */
    public function push($collectionName, $recordID, $key, $val)
    {
        $update = array('$push' => array($key => $val));
        $collection = $this->dbo->selectCollection($collectionName);
        $result = $collection->update(array('_id' => new \MongoId($recordID)), $update, array('w' => 1));
    }

    /**
     * desc
     *
     * @param string $collectionName Description
     * @param string $recordID       Description
     * @param string $key            Description
     * @param mixed  $val            Description
     *
     * @return void
     * @access public
     */
    public function pull($collectionName, $recordID, $key, $val)
    {
        $update = array('$pull' => array($key => $val));
        $collection = $this->dbo->selectCollection($collectionName);
        $collection->update(array('_id' => new \MongoId($recordID)), $update, array('w' => 1));
    }

}
