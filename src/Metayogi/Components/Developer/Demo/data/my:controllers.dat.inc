<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

$controllers = array();

$controllers[] = array (
  '_id' => '52405fddf311fef81866c244',
  'name' => 'work',
  'label' => 'Works',
  'instances' => 'ssu:work',
  'CRUDpath' => 'admin/work',
  'actions' => array (
    'ListAction' => 'admin/work',
    'CreateAction' => 'admin/work/add',
    'EditAction' => 'admin/work/update',
    'DeleteAction' => 'admin/work/delete',
    'LoadAction' => 'admin/work/display',
  ),
  'behaviours' => array (
    'Behaviours' => 1,
    'Search' => 1,
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
      1 => 
      array (
        'event' => 'action.pre',
        'listener' => '\\Metayogi\\Components\\Core\\Search\\SearchListener',
        'method' => 'onDelete',
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
      2 => 
      array (
        'event' => 'form.reload',
        'listener' => '\\Metayogi\\Listener\\InputElementListener',
      ),
      3 => array (
        'event' => 'action.post',
        'listener' => '\\Metayogi\\Components\\Core\\Search\\SearchListener',
        'method' => 'onSave',
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
      2 => 
      array (
        'event' => 'form.reload',
        'listener' => '\\Metayogi\\Listener\\InputElementListener',
      ),
      3 => 
      array (
        'event' => 'action.post',
        'listener' => '\\Metayogi\\Components\\Core\\Search\\SearchListener',
        'method' => 'onSave',
      ),
    ),
  ),
  'rdf:type' => 'my:controllers',
);

/*
* Admin Search
*/

$controllers[] = array (
  '_id' => '524c7c31f311fede35724063',
  'name' => 'works',
  'label' => 'Admin Search',
  'instances' => 'my:works',
  'CRUDpath' => 'admin/works',
  'routeID' => 
  array (
    'SearchAction' => '524c7c31f311fede35724068',
    'LoadAction' => '524c7c31f311fede35724069',
  ),
  'classID' => '524c7c0ef311fedb35461675',
  'rdf:type' => 'my:controllers',
);