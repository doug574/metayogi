<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
 
namespace Metayogi\Components\Core\Relation;

use Metayogi\Form\Element\CollectionElement;
 
/**
 * desc
 * 
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class RelationElement extends CollectionElement
{
    /**
    * {@inheritdoc}
    */
    public function build($properties)
    {
		parent::build($properties);
        if (is_array($properties['collection'])) {
            $this->collection = $properties['collection']['name'];
        } else {
            $this->collection = $properties['collection'];
        }
        if (! empty($this->value['_id'])) {
            $this->value = $this->value['_id'];
        }
		if (! is_array($this->value)) {
			$this->value = array($this->value);
		}
print_r($this->value);
        }
 
    /**
     * Short description for function
     *
     * @return array Return description (if any) ...
     * @access public
     */
    public function submit()
    {
        if (! $this->repeatable) {
            if (! empty($this->value[0])) {
                return array('_id' => $this->value[0], '_ref' => $this->collection);
            }
        } else if (count($this->value) >= 1) {
            return array('_id' => $this->value, '_ref' => $this->collection);
        }
        
        return '';
    }
 
}