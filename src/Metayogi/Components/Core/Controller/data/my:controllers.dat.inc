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
  'instances' => 'my:controllers',
  'CRUDpath' => 'admin/controllers',
  'actions' => array (
    'ListAction' => 'admin/controllers',
    'ToggleAction' => 'admin/controllers/toggle',
  ),
  'listeners' => array (
    '\\Metayogi\\Action\\ListAction' => array (
      0 => array (
        'event' => 'action.pre',
        'listener' => '\\Metayogi\\Listener\\FilterListener',
      ),
    ),
    '\\Metayogi\\Components\\Core\\Controller\\ToggleAction' => array (
      0 => array (
        'event' => 'action.post',
        'listener' => '\\Metayogi\\Listener\\RedirectListener',
        'priority' => -100,
      ),
    ),
  ),
  'rdf:type' => 'my:controllers',
);

