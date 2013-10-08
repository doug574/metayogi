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
  'collection' => 'ssu:work',
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
  'listeners' => array (
    'model' => array (
      '52546c78f311fe9f7a2010b6' => array (
        'action' => '\\Metayogi\\Action\\ListAction',
        'event' => 'action.pre',
        'listener' => '\\Metayogi\\Listener\\FilterListener',
      ),
      '52546c83f311fe9c3e15e341' => array (
        'action' => '\\Metayogi\\Action\\DeleteAction',
        'event' => 'action.post',
        'listener' => '\\Metayogi\\Listener\\RedirectListener',
        'priority' => -100,
      ),
      '52546c88f311fea57ac369cb' => array (
        'action' => '\\Metayogi\\Action\\DeleteAction',
        'event' => 'action.pre',
        'listener' => '\\Metayogi\\Components\\Core\\Search\\SearchListener',
        'method' => 'onDelete',
      ),
      '52546c8cf311fea17a645b5b' => array (
        'action' => '\\Metayogi\\Action\\CreateAction',
        'event' => 'action.post',
        'listener' => '\\Metayogi\\Listener\\RedirectListener',
        'priority' => -100,
      ),
      '52546c91f311fe9e7aee3195' => array (
        'action' => '\\Metayogi\\Action\\CreateAction',
        'event' => 'action.cancel',
        'listener' => '\\Metayogi\\Listener\\RedirectListener',
        'priority' => -100,
      ),
      '52546c95f311fe9f7a0c0174' => array (
        'action' => '\\Metayogi\\Action\\CreateAction',
        'event' => 'form.reload',
        'listener' => '\\Metayogi\\Listener\\InputElementListener',
      ),
      '52546c9af311fea17a075a6f' => array (
        'action' => '\\Metayogi\\Action\\CreateAction',
        'event' => 'action.post',
        'listener' => '\\Metayogi\\Components\\Core\\Search\\SearchListener',
        'method' => 'onSave',
      ),
      '52546c9ff311fe9e7afbef2d' => array (
        'action' => '\\Metayogi\\Action\\EditAction',
        'event' => 'action.post',
        'listener' => '\\Metayogi\\Listener\\RedirectListener',
        'priority' => -100,
      ),
      '52546ca4f311fe9f7a8a5a09' => array (
        'action' => '\\Metayogi\\Action\\EditAction',
        'event' => 'action.cancel',
        'listener' => '\\Metayogi\\Listener\\RedirectListener',
        'priority' => -100,
      ),
      '52546ca8f311fea17a373420' => array (
        'action' => '\\Metayogi\\Action\\EditAction',
        'event' => 'form.reload',
        'listener' => '\\Metayogi\\Listener\\InputElementListener',
      ),
      '52546caef311fe9e7a070342' => array (
        'action' => '\\Metayogi\\Action\\EditAction',
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
  'collection' => 'my:works',
  'CRUDpath' => 'admin/works',
  'routeID' => 
  array (
    'SearchAction' => '524c7c31f311fede35724068',
    'LoadAction' => '524c7c31f311fede35724069',
  ),
  'classID' => '524c7c0ef311fedb35461675',
  'rdf:type' => 'my:controllers',
);
