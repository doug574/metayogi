<?php
/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Components\Core\Search;

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

    /** desc */
    protected $properties;

    /** desc */
    protected $indexes;

    /** desc */
    protected $fieldset;

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
        $options = $config['options'];
        $this->client = new \SolrClient($options);

        $pingResponse = $this->client->ping();
        if (! $pingResponse->success()) {
            throw new SearchException('Cannot connect to Solr');
        }
    }
 
    public function addDocument($dbh, $doc)
    {
        if (is_null($this->indexes)) {
            $this->indexes = $dbh->fetchAll('my:indexes');
        }
        if (is_null($this->properties)) {
            $this->properties = $dbh->fetchAll('rdf:properties');
        }
        if (is_null($this->fieldset)) {
            $collectionName = $doc['rdf:type'];
			$results = $dbh->query('my:fieldsets', array('model' => $collectionName, 'name' => 'Full'));
			$fieldset = $results['docs'][0]['fields'];

        }
        
        /*
        * Build the Solr doc for indexing
        */
        $solrdoc = new \SolrInputDocument();
        foreach ($this->indexes as $indexID => $index) {
            foreach ($index['properties']['_id'] as $propID) {
                $key = $index['name'] . $index['type'];
                $property = $this->properties[$propID]['qname'];
                if (! empty($doc[$property])) {
                    $values = $doc[$property];
                    if (is_array($values)) {
                        foreach ($values as $val) {
                            $solrdoc->addField($key, $val);
                        }
                    } else {
                        $solrdoc->addField($key, $values);
                    }
                }
            }
            
        }
        $updateResponse = $this->client->addDocument($solrdoc);
        $this->client->commit();

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
            throw new SearchException('Cannot remove document');
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
        $this->client->deleteByQuery("*:*");  /* TODO: delete all records per database */
        $this->client->commit();
    }
    
    public function query($terms, $facets, $attrs)
    {
        

        /*
        * Build query
        */
        $query = new \SolrQuery();
        $query->setQuery($terms);
        $query->setStart($attrs['pagesize'] * $attrs['pagenum']);
        $query->setRows($attrs['pagesize']);
        $query->addField('id');
        $query->addField('recordType_s');

        $queryResponse = $this->client->query($query);
        $response = $queryResponse->getResponse();
#print_r($response); exit;
        $results = array();
        $results['numFound'] = $response['response']['numFound'];
        $results['pagenum'] = $attrs['pagenum'];
        $results['rows'] = count($response['response']['docs']);
        $results['pagesize'] = $response['responseHeader']['rows'];
#        $results['pagesize'] = $attrs['pagesize'];
#		$results['start'] = 1 + ($attrs['pagesize'] * $attrs['pagenum']);
        $results['docs'] = $response['response']['docs'];
#        $app->data['path'] = $app->route['controller']['CRUDpath'] . '/search';
#        $app->data['facets'] = $results['facet_counts'];

        return $results;
    }
}
