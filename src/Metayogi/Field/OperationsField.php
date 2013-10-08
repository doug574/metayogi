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
        $controller = $this->router->get('controller');
        if ($controller['collection'] != $doc['rdf:type']) {
            $query = $this->dbh->query('my:controllers', array('collection' => $doc['rdf:type']));
            $controller = $query['docs'][0];
        }
        $actions = array_keys($controller['actions']);
        sort($actions);
        $basepath =  '/' . $controller['CRUDpath'] . '/';
        $this->iActions = array();
        foreach ($actions as $action) {
            $item = $this->registry->get("actions.$action");
            $item['url'] = $basepath . $this->registry->get("actions.$action.verb");
            if ($this->registry->has("actions.$action.params.id")) {
                $item['params'] = array('id' => (string) $doc['_id']);
                if (isset($item['callback'])) {
                    $item['params'] = call_user_func($item['callback'], $item, $doc);
                }
                if (! empty($item['params'])) {
                $this->iActions[] = $item;
                }
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
            $html .= "<a href='$url' class='btn btn-default btn-sm'>" . $action['label'] . "</a> ";
        }

        return $html;
    }
}
