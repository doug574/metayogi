<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Components\Core\SearchWizard;

use Metayogi\Event\ApplicationEvent;
use Metayogi\Foundation\Kernel;

/**
 * desc
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class SearchWizard
{
    protected $dbh;
    protected $router;
    protected $registry;
    protected $data;

    protected $views;
    protected $routes;
    protected $path;
    protected $controllerID;
    protected $advanced;
    
    public function __construct($dbh, $router, $registry, $data)
    {
        $this->dbh = $dbh;
        $this->router = $router;
        $this->registry = $registry;
        $this->data = $data->getStore();

        $this->advanced = 0;
    }
    
    public function create()
    {
        $this->path = $this->data['name'];
        if ($this->data['layout'] == '4eda94436c10ba3216000000') { /* admin */
            $this->path = 'admin/' . $this->path;
        }

        if (! empty($this->data['advanced']['advanced_fields'])) {
            $this->advanced = 1;
        }

        /*
        * Create a controller ID for inserting as a link in other entities
        */
        $this->controllerID = $this->dbh->createID();

        $this->addViews();
        $this->addRoutes();
        $this->addController();
        $this->addMenu();
        
        /*
        * Add controller ID into sform class
        */ 
        $this->dbh->set('my:sforms', (string) $this->data['_id'], 'controllerID', $this->controllerID);
#exit;
    }

    public function update()
    {
        $this->updateViews();
    }

    public function delete()
    {
        $instance = $this->router->getInstance();
        $controllerID = $instance['controllerID'];
        
        $this->dbh->removeBulk(Kernel::ROUTE_COLLECTION, array('controller._id' => $controllerID));
        $this->dbh->removeBulk(Kernel::VIEW_COLLECTION, array('controllerID' => $controllerID));
        $this->dbh->remove(Kernel::CONTROLLER_COLLECTION, $controllerID);
        $this->deleteMenu();
    }
    
    protected function addRoutes()
    {
        $this->routes = array();

        /* search action; basic search; results display */
        $obj = array();
        $obj['alias'] = $this->path . '/search';
        $obj['output'] = 'html';
        $obj['action'] = 'Metayogi\\Components\\Core\\Search\\SearchAction';
        $obj['layout'] = array('_id' => $this->data['layout'], '_ref' => 'my:layouts');
        $obj['view'] = array('_id' => $this->views['SearchResultsDisplay'], '_ref' => 'my:views');
        $obj['model'] = array('_id' => (string) $this->data['_id'], '_ref' => 'my:sforms');
        $obj['controller'] = array('_id' => $this->controllerID, '_ref' => 'my:controllers');
		$obj['parameters'] = array('pagesize' => 10);
        $obj['rdf:type'] = 'my:routes';
        $this->dbh->insert(Kernel::ROUTE_COLLECTION, $obj);
        $this->routes['SearchAction'] = (string) $obj['_id'];

        /* search action; advanced search; results display */
        if ($this->advanced) {
            $obj = array();
            $obj['alias'] = $this->path . '/advanced';
            $obj['output'] = 'html';
            $obj['action'] = 'Metayogi\\Components\\Core\\Search\\SearchAction';
            $obj['layout'] = array('_id' => $this->data['layout'], '_ref' => 'my:layouts');
            $obj['view'] = array('_id' => $this->views['AdvancedSearchResultsDisplay'], '_ref' => 'my:views');
            $obj['model'] = array('_id' => (string) $this->data['_id'], '_ref' => 'my:sforms');
            $obj['controller'] = array('_id' => $this->controllerID, '_ref' => 'my:controllers');
            $obj['parameters'] = array('pagesize' => 10);
            $obj['rdf:type'] = 'my:routes';
            $this->dbh->insert(Kernel::ROUTE_COLLECTION, $obj);
            $this->routes['SearchAction'] = (string) $obj['_id'];
        }

        /* search action; single record display */
        $obj = array();
        $obj['alias'] =  $this->path . '/record';
        $obj['output'] = 'html';
        $obj['action'] = 'Metayogi\\Components\\Core\\Search\\SearchAction';
        $obj['layout'] = array('_id' => $this->data['layout'], '_ref' => 'my:layouts');
        $obj['view'] = array('_id' => $this->views['SearchRecordDisplay'], '_ref' => 'my:views');
        $obj['model'] = array('_id' => (string) $this->data['_id'], '_ref' => 'my:sforms');
        $obj['controller'] = array('_id' => $this->controllerID, '_ref' => 'my:controllers');
		$obj['parameters'] = array('pagesize' => 10);
        $obj['rdf:type'] = 'my:routes';
        $this->dbh->insert(Kernel::ROUTE_COLLECTION, $obj);
        $this->routes['LoadAction'] = (string) $obj['_id'];
    }
    
    protected function addViews()
    {
		$sformID = (string) $this->data['_id'];
		
        /*
        * SearchResultsDisplay - basic search
        */
        $view = array();
        $view['decorators']['pre'] = array('Metayogi\\Components\\Core\\Search\\SearchFormDecorator', 'Metayogi\\Components\\Core\\Search\\TermsDecorator', 'Metayogi\\Decorator\\PagerDecorator');
        $view['display'] = 'Metayogi\\Display\\ListDisplay';
        $view['TitleDecorator']['label'] = $this->data['label'] . ' Results';
		$view['SearchFormDecorator'] = array (
			'layout' => 'form-inline',
			'elements' => $this->getFields('basic'),
        );
		if (! empty($this->facets)) {
			$view['FacetDecorator'] = $this->registry->get('decorators.FacetDecorator.defaults');
			$view['FacetDecorator']['facets'] = $this->facets;
			array_unshift($view['decorators']['pre'], 'FacetDecorator');
		}
		$view['ListDisplay'] = $this->registry->get('displays.ListDisplay.defaults');
        $view['controllerID'] = $this->controllerID;
		$view['sformID'] = $sformID;
        $view['rdf:type'] = 'my:views';
        $this->dbh->insert('my:views', $view);
        $this->views['SearchResultsDisplay'] = (string) $view['_id'];

        /*
        * SearchResultsDisplay - advanced search
        */
        if ($this->advanced) {
            $view = array();
            $view['decorators']['pre'] = array('Metayogi\\Components\\Core\\Search\\SearchFormDecorator', 'Metayogi\\Components\\Core\\Search\\TermsDecorator', 'Metayogi\\Decorator\\PagerDecorator');
            $view['display'] = 'Metayogi\\Display\\ListDisplay';
            $view['TitleDecorator']['label'] = $this->data['label'] . ' Results';
            $view['SearchFormDecorator'] = array (
                'layout' => 'form-horizontal',
                'elements' => $this->getFields('advanced'),
            );
            if (! empty($this->facets)) {
                $view['FacetDecorator'] = $this->registry->get('decorators.FacetDecorator.defaults');
                $view['FacetDecorator']['facets'] = $this->facets;
                array_unshift($view['decorators']['pre'], 'FacetDecorator');
            }
            $view['ListDisplay'] = $this->registry->get('displays.ListDisplay.defaults');
            $view['controllerID'] = $this->controllerID;
            $view['sformID'] = $sformID;
            $view['rdf:type'] = 'my:views';
            $this->dbh->insert('my:views', $view);
            $this->views['AdvancedSearchResultsDisplay'] = (string) $view['_id'];
        }

		/*
		* SearchRecordDisplay
		*/
		$view = array();
		$view['display'] = 'Metayogi\\Components\\Core\\Search\\SearchRecordDisplay';
		$view['decorators']['pre'] = array('Metayogi\\Components\\Core\\Search\\SearchNavDecorator');
        $view['TitleDecorator']['label'] = $this->data['label'] . ' Display';
		$view['SearchRecordDisplay'] = $this->registry->get('displays.SearchRecordDisplay.defaults');
        $view['controllerID'] = $this->controllerID;
		$view['sformID'] = $sformID; 
        $view['rdf:type'] = 'my:views';
        $this->dbh->insert('my:views', $view);
        $this->views['SearchRecordDisplay'] = (string) $view['_id'];

    }
    
    protected function addController()
    {
        $classID = (string) $this->data['_id'];
        $controller = array();
        $controller['_id'] = $this->controllerID;
        $controller['name'] = $this->data['name'];
        $controller['label'] = $this->data['label'];
        $controller['instances'] =  'my:' .  $this->data['name'];
        $controller['CRUDpath'] = 'admin/' . $this->data['name'];
        $controller['routeID'] = $this->routes;
        $controller['classID'] = $classID;
        $controller['rdf:type'] = 'my:controllers';
        $this->dbh->insert(Kernel::CONTROLLER_COLLECTION, $controller);
    }
    
    protected function addMenu()
    {
        if ($this->data['layout'] == '4eda94436c10ba3216000000') {  /* admin */
            $menuID = '50080fcef311fef627000002';
        } else { /* public */
            $menuID = '506bf1360de404f60d000029';
        }
        
        if (! $this->advanced) {
            $this->dbh->set('my:menus', $menuID, 'menuitems.5search', array(
                'method' => 'link',
                'menuitemtitle' => 'Search',
                'menuitempath' => $this->path . '/search'
            ));
        } else {
            $this->dbh->set('my:menus', $menuID, 'menuitems.5search', array(
                'method' => 'dropdown',
                'menuitemtitle' => 'Search',
                'menuitems' => array (
                    0 => array (
                        'method' => 'link',
                        'menuitemtitle' => 'Basic',
                        'menuitempath' => $this->path . '/search'
                    ),
                    1 => array (
                        'method' => 'link',
                        'menuitemtitle' => 'Advanced',
                        'menuitempath' => $this->path . '/advanced'
                    ),
                ),
            ));
        }
    }
    
    protected function updateViews()
    {
    }
    
    protected function deleteMenu()
    {
    }

    protected function getFields($type)
    {
        $fields = array();
        $indexes = $this->dbh->fetchAll('my:indexes');

		$number = $type . '_fields';
		$selected = $type . '_indexes';
        $data = $this->data[$type];
        
        if ((! empty($data[$selected])) && (! empty($data[$number]))) {
			$options = array();
			foreach ($data[$selected] as $indexID) {
				$name = $indexes[(string)$indexID]['name'] . $indexes[(string)$indexID]['type'];
				$options[$name] = $indexes[$indexID]['label'];
			}
			$number = $data[$number];
			for ($i=0; $i<$number; $i++) {
                $name = 'term' . $i;

                if (count($options == 1)) {
                    $field = array();
                    $field['widget'] = 'Metayogi\\Form\\Element\\HiddenElement';
                    $keys = array_keys($options);
                    $field['value'] = array_shift($keys);
                    $fields['index_' . $name] = $field;
                } else {
                    $field = array();
                    $field['optionslist'] = $options;
                    $field['widget'] = 'Metayogi\\Form\\Element\\SelectElement';
                    $fields['index_' . $name] = $field;
                }
                
                $field = array();
                $field['widget'] = 'Metayogi\\Form\\Element\\InputElement';
                $fields[$name] = $field;
            }
			$field = array();
			$field['widget'] = 'Metayogi\\Form\\Element\\HiddenElement';
			$field['value'] = $number;
			$fields['cnt'] = $field;
        }
print "<h2>$type</h2>";
print_r($this->data);
print "<hr>";
print_r($fields);

        return $fields;
    }
}