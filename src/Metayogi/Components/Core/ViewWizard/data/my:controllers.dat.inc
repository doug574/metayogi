<?php

$controllers = array();

$controllers[] = array (
  '_id' => '4ecd57ac6c10bad80a010000',
  'label' => 'View',
  'name' => 'view',
  'collection' => 'my:views',
  'CRUDpath' => 'admin/views',
  'hooks' => array (
    'myCreateAction' => array (
      'pre' => array (
        0 => 'myViewCreateHook',
      ),
    ),
    'myEditAction' => array (
      'pre' => array (
        0 => 'myViewEditHook',
      ),
      'post' => array('myCacheEditHook'),
    ),
    'myDeleteAction' => array (
      'pre' => array('myCacheDeleteHook'),
    ),

  ),
  'actions' => array (
    'ListAction' => '4ecd580b6c10bad50a000000',
    /* 'CreateAction' => '4ecd5e476c10bad40a000000', */
    'EditAction' => '4ed5e7896c10ba0230060000',
    'DeleteAction' => '4ed5e7aa6c10ba05300c0000',
    /* 'LoadAction' => '4ecd5e2b6c10bad80a020000', */
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

$controllers[] = array (
  '_id' => '51d54002f311fe7509586a5d',
  'name' => 'fieldsets',
  'label' => 'Fieldset',
  'collection' => 'my:fieldsets',
  'CRUDpath' => 'admin/fieldsets',
  'actions' => array (
    'CreateAction' => 'admin/fieldsets/add',
    'ListAction' => 'admin/fieldsets',
    'EditAction' => 'admin/fieldsets/update',
    'DeleteAction' => 'admin/fieldsets/delete',
    'LoadAction' => 'admin/fieldsets/display',
  ),
  'hooks' => array (
    'myCreateAction' => array (
      'pre' => array (
        0 => 'myFieldsetCreateHook',
      ),
    ),
    'myEditAction' => array (
      'pre' => array (
        0 => 'myFieldsetEditHook',
      ),
    ),
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
