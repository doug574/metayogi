<?php

$controllers = array();

$controllers[] = array (
  '_id' => '4ee0fa716c10baf069090000',
  'label' => 'User',
  'name' => 'user',
  'collection' => 'my:users',
  'CRUDpath' => 'admin/user',
  'actions' => array (
    'ListAction' => '4ef0fb9d6c10ba2a62030000',
    'CreateAction' => '4ef0f5906c10ba2e62040000',
    'EditAction' => '4ef0fc116c10ba8363060000',
    'DeleteAction' => '505792c8f311fec91b000000',
    /* 'LoadAction' => '4ef0fc6e6c10ba8c7c000000', */
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

