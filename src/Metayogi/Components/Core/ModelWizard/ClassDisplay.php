<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Components\Core\ModelWizard;

use Metayogi\Display\BaseDisplay;
use Metayogi\Display\DisplayInterface;

/**
 * Class for displaying a record using a view passed via controller object
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class ClassDisplay extends BaseDisplay implements DisplayInterface
{

	/** desc */
	protected $fields;
	
	/** desc */
	protected $propertiesUrl;

	/** desc */
	protected $classesUrl;
	
    /** desc */
    protected $superclasses;
    

    /**
     * Description
     *
     * @return void
     * @access public
     */
    public function build()
    {
		$this->fields = array();
        $this->superclasses = array();
        $instance = $this->router->getInstance();
		$comment = "";
		if (! empty($instance['comment'])) {
			$comment = $instance['comment'];
		}
		$this->fields[] = array('label' => $instance['label'], 'comment' => $comment, 'properties' => $instance['properties'], 'id' => (string) $instance['_id']);

#        print_r($instance);
        
if (! empty($instance['subclass'])) {		
		foreach ($instance['subclass'] as $superclass) {
#        print_r($superclass);
/*
            $model = $app->dbh->load('rdfs:classes', $superclass);
			$props = array();
			if (! empty ($model['properties'])) {
			foreach ($model['properties'] as $propID) {
				$prop = array();
				$prop['label'] = $properties[$propID]['label'];
				$prop['type'] = $properties[$propID]['range'];
				$prop['desc'] = $properties[$propID]['comment'];
				$prop['id'] = (string) $properties[$propID]['_id'];
				$props[] = $prop;
			}
			}
*/
            $label = $superclass['label'];
#print "<p>XX: $label</p>\n";
			$this->fields[] = array('label' => $label, 'properties' => $superclass['properties'], 'id' => $superclass['_id']);
		}
}	

        $results = $this->dbh->query('rdfs:classes', array('subclass._id' => (string) $instance['_id']));
#print_r($results);
        if ($results['numFound'] > 0) {
            foreach ($results['docs'] as $doc) {
                $id = (string) $doc['_id'];
                $this->superclasses[$id] = $doc['label'];
            }
        }
	
		$this->propertiesUrl = '/admin/properties/display';
		$this->classesUrl = '/admin/classes/display';
    }


    /**
     * Description
     *
     * @return string
     * @access public
     */
    public function render()
    {
#print_r($this->fields);
        $html = "<p>" . $this->fields[0]['comment'] . "</p>\n";
        $html .= "<table class='table table-bordered table-condensed table-hover'>\n";
		$html .= "<thead><tr><th>Property</th><th>Type</th><th>Description</th></tr></thead>\n";
        foreach ($this->fields as $field) {
			$url = $this->classesUrl . '?id=' . $field['id'];
			$html .= "<thead><tr><th colspan='3'>Properties from <a href='$url'>" . $field['label'] . "</a></th></tr></thead>\n";
			foreach ($field['properties'] as $property) {
				$url = $this->propertiesUrl . '?id=' . $property['_id'];
				$html .= "<tr>";
				$html .= "<td><a href='$url'>" . $property['label'] . "</a></td>\n";
                if ($property['propertyType'] == 'Literal') {
                    $html .= "<td>" . $property['range'] . "</td>\n";
                } else {
                    $html .= "<td>" . $property['collection'] . "</td>\n";
                }
				$html .= "<td>" . $property['comment'] . "</td>\n";
				$html .= "</tr>";
			}
        }
        $html .= "</table>\n";
        
        if (! empty($this->superclasses)) {
            $html .= "<div>More specific types</div>\n";
            $html .= "<ul>\n";
            foreach ($this->superclasses as $id => $label) {
                $url = $this->classesUrl . '?id=' . $id;
                
                $html .= "<li><a href='$url'>$label</a></li>\n";
            }
            $html .= "</ul>\n";
        }
#print_r($this->superclasses);
        return $html;
    }
}
