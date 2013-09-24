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
    'ListAction' => '504a6d90f311fefa6e000009',
/*    'CreateAction' => '504f6478f311fed94d000000', */
    'EditAction' => '504a6daaf311feff6e000005',
/*    'DeleteAction' => '505214eff311fee27b000000', */
    'LoadAction' => '504a6e66f311fefe6e000008',
  ),
    'listeners' => 
  array (
    '\\Metayogi\\Action\\ListAction' => 
    array (
      0 => 
      array (
        'event' => 'action.pre',
        'listener' => '\\Metayogi\\Listener\\FilterListener',
      ),
    ),
    '\\Metayogi\\Action\\DeleteAction' => 
    array (
      0 => 
      array (
        'event' => 'action.post',
        'listener' => '\\Metayogi\\Listener\\RedirectListener',
        'priority' => -100,
      ),
    ),
    '\\Metayogi\\Action\\CreateAction' => 
    array (
      0 => 
      array (
        'event' => 'action.post',
        'listener' => '\\Metayogi\\Listener\\RedirectListener',
        'priority' => -100,
      ),
      1 => 
      array (
        'event' => 'action.cancel',
        'listener' => '\\Metayogi\\Listener\\RedirectListener',
        'priority' => -100,
      ),
    ),
    '\\Metayogi\\Action\\EditAction' => 
    array (
      0 => 
      array (
        'event' => 'action.post',
        'listener' => '\\Metayogi\\Listener\\RedirectListener',
        'priority' => -100,
      ),
      1 => 
      array (
        'event' => 'action.cancel',
        'listener' => '\\Metayogi\\Listener\\RedirectListener',
        'priority' => -100,
      ),
    ),
  ),
  'rdf:type' => 'my:controllers',
);

