<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
 
namespace Metayogi\Form\Element;

use Metayogi\Form\Element\SelectElement;
 
/**
 * desc
 * 
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class CollectionElement extends SelectElement
{
    /**
    * {@inheritdoc}
    */
    public function build($properties)
    {
		parent::build($properties);
        $this->list = $this->fetchList($properties['collection']);
    }

    /**
    *
    * @access protected
    * @param string $collection
    * @return array
    */
    protected function fetchList($collection)
    {
    $query = array();
        
    if (is_array($collection)) {
        if (! empty($collection['filters'])) {
            $query = $collection['filters'];
        }
        extract($collection);
        if ((! isset($name)) || (! isset($keys)) || (! isset($values))) {
            throw new \Exception('Invalid Element');
        }
    } else {
            $name = $collection;
            $keys = '_id';
   }
        
        $results = $this->dbh->query($name, $query);
#print_r($results);
        $list = array();
        if (empty($results['docs'])) {
            return $list;
        }
        foreach ($results['docs'] as $term) {
#print_r($term);
        if (! is_array($collection)) {
            $tmp = array_keys($term);
            $values = $tmp[1];
			}
            $key = (string) $term[$keys];
#            $list[$key] = htmlspecialchars(myUtil::folded_value($values, $term));
            $list[$key] = $term[$values];
        }

#        if (! empty($collection['options'])) {
#            foreach ($collection['options'] as $key => $val) {
#                $list[$key] = $val;
#            }
#        }

        return $list;
    }
}