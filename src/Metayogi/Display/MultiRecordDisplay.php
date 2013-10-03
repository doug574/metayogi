<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Display;

/**
 * Base class for multi-record displays
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
abstract class MultiRecordDisplay extends BaseDisplay
{
    /** desc */
    protected $records;

    /** desc */
    protected $fieldsets;
 
    /** desc */
    protected $properties;
    
    /**
     * Description
     *
     * @return void
     * @access public
     */
    public function build()
    {
        if ($this->data->get('numFound') == 0) {
            return;
        }

        /*
        * Set display properties
        */
        $this->properties = $this->getProperties();

        /*
        * Find fieldset for each record in the result list
        */
        $this->fieldsets = array();
        foreach ($this->data->get('docs') as $doc) {
            $rdfType = $doc['rdf:type'];
            if (empty($this->fieldsets[$rdfType])) {
                if (! empty($this->properties['fields'])) {
                    $this->fieldsets[$rdfType] = $this->properties['fields'];
                } elseif (! empty($this->properties['fieldset'])) {
                    $this->fieldsets[$rdfType] = $this->properties['fieldset']['fields'];
                } elseif (! empty($this->properties['fieldsetName'])) {
                    $fieldsetName = $this->properties['fieldsetName'];
                    $query = $this->dbh->query('my:fieldsets', array('model' => $rdfType, 'name' => $fieldsetName));
                    $this->fieldsets[$rdfType] = $query['docs'][0]['fields'];
                } else {
                    throw new \Exception("No fieldset");
                }
                
            }
        }

        /*
        * Create records (arrays of field objects)
        */
        foreach ($this->data->get('docs') as $doc) {
            $rdfType = $doc['rdf:type'];
            $fieldset = $this->fieldsets[$rdfType];
            $fields = array();
            #print_r($fieldset);
            foreach ($fieldset as $fieldName => $field) {
                $field['name'] = $fieldName;
                $gadget = new $field['gadget']($this->dbh, $this->router, $this->registry);
                $gadget->build($field, $doc);
                $fields[] = $gadget;
            }
            $this->records[] = $fields;
        }
    }

    protected function getProperties()
    {
        $fqn = get_class($this);
        $words = explode('\\', $fqn);
        $classname = $words[count($words)-1];
        $view = $this->router->get('view');
       
        return $view[$classname];
    }
}
