<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

$controllers = array();

$controllers[] = array (
  '_id' => '504a6df2f311fefb6e00000c',
  'name' => 'controller',
  'label' => 'Controller',
  'collection' => 'my:controllers',
  'CRUDpath' => 'admin/controllers',
  'actions' => array (
    'ListAction' => 'admin/controllers',
    'ToggleAction' => 'admin/controllers/toggle',
  ),
  'listeners' => array (
    'model' => array (
      '525465def311fea57a4effc4' => array (
        'action' => '\\Metayogi\\Action\\ListAction',
        'event' => 'action.pre',
        'listener' => '\\Metayogi\\Listener\\FilterListener',
      ),
      '525465e3f311fea47a6a216f' => array (
        'action' => '\\Metayogi\\Components\\Core\\Controller\\ToggleAction',
        'event' => 'action.post',
        'listener' => '\\Metayogi\\Listener\\RedirectListener',
        'priority' => -100,
      ),
    ),
  ),
  'rdf:type' => 'my:controllers',
);

