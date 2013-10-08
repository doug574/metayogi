<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Components\Core\ModelWizard;

use Metayogi\Event\ApplicationEvent;
use Metayogi\Foundation\Kernel;

/**
 * desc
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class ModelWizard
{
    protected $dbh;
    protected $router;
    protected $registry;
    protected $data;
    
    protected $actions;
    protected $controllerID;
    protected $displayIDs;
    protected $fieldsetIDs;
    protected $model;
    
    public function __construct($dbh, $router, $registry, $data)
    {
        $this->dbh = $dbh;
        $this->router = $router;
        $this->registry = $registry;
        $this->data = $data->getStore();
    }
    
    public function create()
    {
        $this->model = $this->dbh->load(Kernel::MODEL_COLLECTION, (string) $this->data['_id'], $this->registry->get('cache'));
        $this->actions = array('ListAction', 'CreateAction', 'EditAction', 'DeleteAction', 'LoadAction');
        $this->controllerID = $this->dbh->createID();
        $this->displayIDs = array();
        $this->displayIDs['ListAction'] = $this->dbh->createID();
        $this->displayIDs['CreateAction'] = $this->dbh->createID();
        $this->displayIDs['EditAction'] = $this->displayIDs['CreateAction'];
        $this->displayIDs['LoadAction'] = $this->dbh->createID();
        $this->fieldsetIDs['List'] = $this->dbh->createID();
        $this->fieldsetIDs['Brief'] = $this->dbh->createID();
        $this->fieldsetIDs['Full'] = $this->dbh->createID();
        $this->fieldsetIDs['Form'] = $this->dbh->createID();
        
        $this->addRoutes($this->dbh, $this->registry, $this->data);
        $this->addController($this->dbh, $this->registry, $this->data);
        $this->addDisplays($this->dbh, $this->registry, $this->data);
        $this->addFieldsets($this->dbh, $this->registry, $this->data);
    }

    public function update()
    {
        $this->updateFieldsets();
        $this->updateComponents();
    }
    
    public function delete()
    {
        if (! empty($this->data['abstract'])) {
            return;
        }
        
        $controller = $this->router->get('controller');
        $controllerID = (string) $controller['_id'];
        $qname = $this->data['qname'];
        
        /* Drop collection */
        $collectionName = $controller['collection'];
        $this->dbh->collectionDrop($collectionName);
        $this->dbh->collectionDrop($collectionName . ".cache");

        /* Delete routes */
        $this->dbh->removeBulk(Kernel::ROUTE_COLLECTION, array('controller._id' => $controllerID));
        
        /* Delete views */
        $this->dbh->removeBulk(Kernel::VIEW_COLLECTION, array('controllerID' => $controllerID));
        
        /* Delete fieldsets */
        $this->dbh->removeBulk(Kernel::FIELDSET_COLLECTION, array('model' => $qname));
        
        /* Delete permissions */
        $this->dbh->removeBulk(Kernel::RBAC_COLLECTION, array('controller' => $qname));
        
        /* Delete controller */
        $this->dbh->remove(Kernel::CONTROLLER_COLLECTION, $controllerID);
    }
    
    protected function addRoutes($dbh, $registry, $data)
    {
        $actions = $this->actions;
        $this->actions = array();
        foreach ($actions as $action) {
            $properties = $registry->get("actions.$action");
            $obj = array();
            $obj['alias'] = 'admin/' . $data['name'];
            if (! empty($properties['verb'])) {
                $obj['alias'] .= '/' . $properties['verb'];
            }
            $obj['output'] = 'html';
            $obj['action'] = '\\Metayogi\\Action\\' . $action;
            $obj['layout'] = array ('_id' => Kernel::ADMIN_LAYOUT, '_ref' => Kernel::LAYOUT_COLLECTION);
            if ($action != 'DeleteAction') {
                $obj['view'] = array('_id' => $this->displayIDs[$action], '_ref' => Kernel::VIEW_COLLECTION);
            }
            $obj['model'] = array('_id' => (string) $data['_id'], '_ref' => Kernel::MODEL_COLLECTION);
            $obj['controller'] = array('_id' => $this->controllerID, '_ref' => Kernel::CONTROLLER_COLLECTION);
            $obj['rdf:type'] = Kernel::ROUTE_COLLECTION;
            $dbh->insert(Kernel::ROUTE_COLLECTION, $obj);
            $this->actions[$action] = $obj['alias'];
        }
    }
    
    protected function addController($dbh, $registry, $data)
    {        
        /* Listeners */
        $listeners = array(
            '\\Metayogi\\Action\\ListAction' => array (
                0 => array( 'event' => 'action.pre', 'listener' => '\\Metayogi\\Listener\\FilterListener'),
            ),
            '\\Metayogi\\Action\\DeleteAction' => array (
                0 => array( 'event' => 'action.post', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
            ),
            '\\Metayogi\\Action\\CreateAction' => array (
                0 => array( 'event' => 'action.post', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
                1 => array( 'event' => 'action.cancel', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
                2 => array ('event' => 'form.reload', 'listener' => '\\Metayogi\\Listener\\InputElementListener'),
            ),
            '\\Metayogi\\Action\\EditAction' => array (
                0 => array( 'event' => 'action.post', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
                1 => array( 'event' => 'action.cancel', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
                2 => array ('event' => 'form.reload', 'listener' => '\\Metayogi\\Listener\\InputElementListener'),
            ),
        );

        $obj = array();
        $obj['_id'] = $this->controllerID;
        $obj['name'] = $data['name'];
        $obj['label'] = $data['label'];
        $obj['collection'] =  $data['domain'] . ':' .  $data['name'];
        $obj['behaviours'] = 1;
        $obj['CRUDpath'] = 'admin/' . $data['name'];
        $obj['actions'] = $this->actions;
        $obj['listeners'] = $listeners;        
        $obj['rdf:type'] = Kernel::CONTROLLER_COLLECTION;
        $dbh->insert(Kernel::CONTROLLER_COLLECTION, $obj);
    }
    
    protected function addDisplays($dbh, $registry, $data)
    {
        /* Form Display */
        $obj = array();
        $obj['_id'] = $this->displayIDs['CreateAction'];
        $obj['label'] = $data['label'] . ' Form';
        $obj['display'] = '\\Metayogi\\Display\\FormDisplay';
		$obj['decorators'] = array('pre' => array('\\Metayogi\\Decorator\\TitleDecorator'));
        $obj['TitleDecorator'] = array('label' => $data['label'] . ' Form');
        $obj['FormDisplay'] = array(
            'layout' => 'form-horizontal',
			'help' => 'help-stacked',
            'elementset' => array('_id' => $this->fieldsetIDs['Form'], '_ref' => Kernel::FIELDSET_COLLECTION),
        );
        $obj['rdf:type'] = Kernel::VIEW_COLLECTION;
        $dbh->insert(Kernel::VIEW_COLLECTION, $obj);
        
        /* List Display */
        $obj = array();
        $obj['_id'] = $this->displayIDs['ListAction'];
        $obj['label'] = $data['label'] . ' List';
        $obj['display'] = '\\Metayogi\\Display\\TableDisplay';
		$obj['decorators'] = array(
            'pre' => array('\\Metayogi\\Decorator\\TitleDecorator', '\\Metayogi\\Decorator\\CreateDecorator'),
            'post' => array('\\Metayogi\\Decorator\\PagerDecorator', '\\Metayogi\\Decorator\\ConfirmDecorator')
        );
        $obj['TitleDecorator'] = array('label' => $data['label'] . ' List'); 
        $obj['TableDisplay']['fieldset'] = array('_id' => $this->fieldsetIDs['List'], '_ref' => Kernel::FIELDSET_COLLECTION);
        $obj['rdf:type'] = Kernel::VIEW_COLLECTION;
        $dbh->insert(Kernel::VIEW_COLLECTION, $obj);
        
        /* Record Display */
        $obj = array();
        $obj['_id'] = $this->displayIDs['LoadAction'];
        $obj['label'] = $data['label'] . ' Display';
        $obj['display'] = '\\Metayogi\\Display\\RecordDisplay';
		$obj['decorators'] = array('pre' => array('\\Metayogi\\Decorator\\TitleDecorator'));
        $obj['TitleDecorator'] = array('label' => $data['label'] . ' Display'); 
        $obj['RecordDisplay']['fieldset'] = array('_id' => $this->fieldsetIDs['Full'], '_ref' => Kernel::FIELDSET_COLLECTION);
        $obj['rdf:type'] = Kernel::VIEW_COLLECTION;
        $dbh->insert(Kernel::VIEW_COLLECTION, $obj);
    } 
    
    protected function addFieldsets($dbh, $registry, $data)
    {
        /* List */
        $obj = array();
        $obj['_id'] = $this->fieldsetIDs['List'];
        $obj['name'] = 'List';
        $obj['model'] = $data['qname'];
        $obj['fields'] = $this->getGadgets(1);
        $obj['fields']['ops'] = array (
            'gadget' => '\\Metayogi\\Field\\OperationsField',
            'label' => 'Operations',
        );
        $obj['rdf:type'] = Kernel::FIELDSET_COLLECTION;
        $dbh->insert(Kernel::FIELDSET_COLLECTION, $obj);
        
        /* Brief */
        $obj = array();
        $obj['_id'] = $this->fieldsetIDs['Brief'];
        $obj['name'] = 'Brief';
        $obj['model'] = $data['qname'];
        $obj['fields'] = $this->getGadgets(3);
        $obj['fields']['ops'] = array (
            'gadget' => '\\Metayogi\\Field\\OperationsField',
            'label' => 'Operations',
        );
        $obj['rdf:type'] = Kernel::FIELDSET_COLLECTION;
        $dbh->insert(Kernel::FIELDSET_COLLECTION, $obj);
        
        /* Full */
        $obj = array();
        $obj['_id'] = $this->fieldsetIDs['Full'];
        $obj['name'] = 'Full';
        $obj['model'] = $data['qname'];
        $obj['fields'] = $this->getGadgets(-1);
        $obj['rdf:type'] = Kernel::FIELDSET_COLLECTION;
        $dbh->insert(Kernel::FIELDSET_COLLECTION, $obj);
        
        /* Form */
        $obj = array();
        $obj['_id'] = $this->fieldsetIDs['Form'];
        $obj['name'] = 'Form';
        $obj['model'] = $data['qname'];
        $obj['elements'] = $this->getWidgets();
        $obj['rdf:type'] = Kernel::FIELDSET_COLLECTION;
        $dbh->insert(Kernel::FIELDSET_COLLECTION, $obj);
    }
    
    protected function getGadgets($num)
    {
        $gadgets = array();

        /* Class properties */
        $properties = $this->model['properties'];
        foreach ($properties as $qname => $property) {
            $gadgets[$qname] = $property;
        }
        $gadgets['ops'] = array(
            'gadget' => '\\Metayogi\\Field\\OperationsField',
            'label' => 'Operations',
        );
        
        /* Subclass properties */
        $subclasses = $this->model['subclass'];
        foreach ($subclasses as $name => $subclass) {
            $properties = $subclass['properties'];
            foreach ($properties as $qname => $property) {
                $gadgets[$qname] = $property;
            }
        }

        if ($num == -1) {
            return $gadgets;
        }
        
        return array_slice($gadgets, 0, $num+1);
    }

    protected function getWidgets()
    {
        $widgets = array();

        /* Class properties */
        $properties = $this->model['properties'];
        foreach ($properties as $qname => $property) {
            $widgets[$qname] = $property;
        }
    
        /* Subclass properties */
        $subclasses = $this->model['subclass'];
        foreach ($subclasses as $name => $subclass) {
            $properties = $subclass['properties'];
            foreach ($properties as $qname => $property) {
                $widgets[$qname] = $property;
            }
        }
    
        return $widgets;
    }
    
    protected function updateFieldsets()
    {
    }
}
