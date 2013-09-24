<?php
/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Search;

/**
 * Defines interface for database abstraction layer.
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class SolrSearch implements SearchInterface
{
    /** desc */
    protected $client;

    /**
     * Description
     *
     * @param array $config Description
     *
     * @return object
     * @access public
     */
    public function __construct($config)
    {
        $options = $config['search']['options'];
        $this->client = new \SolrClient($options);

        $pingResponse = $this->client->ping();
        if (! $pingResponse->success()) {
            throw new SearchException('Cannot connect to Solr');
        }
    }
 
    public function addDocument()
    {
    }

    /**
     * Description
     *
     * @param string $recid Description
     *
     * @return void
     * @access public
     */
    public function removeDocument($recid)
    {
        try {
            $updateResponse = $this->client->deleteById($recid);
            $this->client->commit();
        } catch (Exception $e) {
            throw new SearchException('Cannot remove document') ;
        }
    }

    public function addCollection()
    {
    }
    
    public function removeCollection()
    {
    }

    public function removeAll()
    {
    }
    
    public function query()
    {
    }
}
