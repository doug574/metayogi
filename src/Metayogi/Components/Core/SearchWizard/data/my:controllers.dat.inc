<?php

$controllers = array();

$controllers[] = array (
  '_id' => '50502f1ef311fee77b000000',
  'name' => 'index',
  'label' => 'Search Index',
  'instances' => 'my:indexes',
  'CRUDpath' => 'admin/indexes',
  'actions' => array (
    'ListAction' => '504fb638f311fed94d00000a',
    'CreateAction' => '504fb638f311fed94d00000b',
    'EditAction' => '504fb638f311fed94d00000c',
    'DeleteAction' => '504fb638f311fed94d00000d',
    /* 'myLoadAction' => '504fb638f311fed94d00000e', */
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
  '_id' => '506d99cb0de404f30d000055',
  'name' => 'sforms',
  'label' => 'Search Form',
  'instances' => 'my:sforms',
  'CRUDpath' => 'admin/sforms',
  'actions' => array (
    'ListAction' => '506d99cb0de404f30d000059',
    'CreateAction' => '506d99cb0de404f30d00005a',
    'EditAction' => '506d99cb0de404f30d00005b',
    'DeleteAction' => '506d99cb0de404f30d00005c',
    /* 'myLoadAction' => '506d99cb0de404f30d00005d', */
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
     1 => array( 'event' => 'action.post', 'listener' => '\\Metayogi\\Components\\Core\\SearchWizard\\SearchFormListener', 'method' => 'onDelete'), 
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
     2 => array( 'event' => 'action.post', 'listener' => '\\Metayogi\\Components\\Core\\SearchWizard\\SearchFormListener', 'method' => 'onCreate'),
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
     2 => array( 'event' => 'action.post', 'listener' => '\\Metayogi\\Components\\Core\\SearchWizard\\SearchFormListener', 'method' => 'onUpdate'),
    ),
  ),
  'rdf:type' => 'my:controllers',
);

