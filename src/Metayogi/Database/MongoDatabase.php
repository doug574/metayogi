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
        if ($recordID == null) {
            throw new DatabaseLoadException("$collectionName No record ID");
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
            throw new DatabaseLoadException("$collectionName  $recordID Load failed");
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
#print "Not in cache<br>\n";
			$doc = $this->load($collectionName, $recordID);

            $collection = $this->dbo->selectCollection($collectionName);
            $doc = $collection->findone($query);
            if ($doc == null) {
                throw new \Exception("$collectionName  Load failed");
            }

			$embedded = $embed[$collectionName];
            $doc['_embedded'] = array();
			foreach ($embedded as $key => $req) {
#print "$key<br>\n";
				if (empty($doc[$key]) && $req == 'r') {
					throw new \Exception("$collectionName  Missing $key");
				}
				
                if (empty($doc[$key])) {
                    continue;
                }
                
                if (empty($doc[$key]['_id']) || empty($doc[$key]['_ref'])) {
                    throw new \Exception("Bad relation");
                }
                
                $_id = $doc[$key]['_id'];
                $_ref = $doc[$key]['_ref'];
                
				/* Single ref */
                if (! is_array($_id)) {
					if (! empty($embed[$_ref])) {
						$doc[$key] = $this->cache($_ref, $_id, $embed);
					} else {
						$doc[$key] = $this->load($_ref, $_id);
					}
                    $doc['_embedded'][] = $_id;
				} else {
				/* Multiple ref */
#print "--multi<br>\n";
#print_r($_id);
                    $doc[$key] = array();
					foreach ($_id as $val) {
#print "--$val $_ref<br>\n";
                        $doc['_embedded'][] = $val;
						if (! empty($embed[$_ref])) {
#print "--embed<br>\n";
							$subdoc = $this->cache($_ref, $val, $embed);
						} else {
#print "--load<br>\n";                       
							$subdoc = $this->load($_ref, $val);
						}
                        if (! empty($subdoc['qname'])) {
                            $name = $subdoc['qname'];
                            $doc[$key][$name] = $subdoc;
                        } else if (! empty($subdoc['name'])) {
                             $name = $subdoc['name'];
                            $doc[$key][$name] = $subdoc;
                        } else {
                            $doc[$key][] = $subdoc;
                        }
                        if (! empty($subdoc['_embedded'])) {
                            $doc['_embedded'] = array_merge($doc['_embedded'], $subdoc['_embedded']);
                        }
					}
				}
			}
			
			$collection = $this->dbo->selectCollection($collectionName . ".cache");
            $collection->insert($doc, array('safe' => true));

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
        if (empty($attrs)) {
            $attrs['pagesize'] = 100;
            $attrs['pagenum'] = 0;
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


}
