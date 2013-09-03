<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Field;

/**
 * Defines the Operations Field class
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class OperationsField extends BaseField implements FieldInterface
{
    /** desc */
    protected $iActions;

    /**
    * {@inheritdoc}
    */
    public function build($properties, $doc)
    {
        parent::build($properties, $doc);
        
        /*
        * Build arrays of item actions and collection actions
        */
        $controller = $this->router->getRoute('controller');
        if ($controller['instances'] != $doc['rdf:type']) {
            $query = $this->dbh->query('my:controllers', array('instances' => $doc['rdf:type']));
            $controller = $query['docs'][0];
        }
        $actions = array_keys($controller['actions']);
        sort($actions);
        
        $basepath =  '/' . $controller['CRUDpath'] . '/';
        $this->iActions = array();
        foreach ($actions as $action) {
            $item = $this->registry->get("actions.$action");
            $item['url'] = $basepath . $this->registry->get("actions.$action.verb");
            if ($this->registry->get("actions.$action.requiresID") == 'true') {
                $item['params'] = array('id' => (string) $doc['_id']);
                $this->iActions[] = $item;
            }
        }
    }

    /**
    * {@inheritdoc}
    */
    public function render()
    {
        $html = "";
        foreach ($this->iActions as $action) {
            $url = $action['url']  . '?' . http_build_query($action['params']);
            $html .= "<a href='$url' class='" . $action['verb'] . " btn btn-mini'>" . $action['label'] . "</a> ";
        }

        return $html;
    }
}
