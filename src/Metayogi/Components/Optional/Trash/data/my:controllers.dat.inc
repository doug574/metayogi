<?php

$controllers = array();

$controllers[] = array (
  '_id' => '4ed495226c10baff2f020000',
  'name' => 'trash',
  'label' => 'Trash',
  'instances' => 'my:trash',
  'CRUDpath' => 'admin/trash',
  'actions' => array (
    'PurgeAction' => '4ee3b13f6c10bacd0b020000',
    'ListAction' => '4ed5c9e06c10ba00300c0000',
    'RecoverAction' => '4ed5d2996c10ba05300a0000',
    'EmptyAction' => '4f78d340f311fe6725000000',
  ),
  'listeners' => 
  array (
    '\\Metayogi\\Components\\Optional\\Trash\\PurgeAction' => 
    array (
      0 => 
      array (
        'event' => 'action.post',
        'listener' => '\\Metayogi\\Listener\\RedirectListener',
        'priority' => -100,
      ),
    ),
    '\\Metayogi\\Components\\Optional\\Trash\\RecoverAction' => 
    array (
      0 => 
      array (
        'event' => 'action.post',
        'listener' => '\\Metayogi\\Listener\\RedirectListener',
        'priority' => -100,
      ),
    ),
    '\\Metayogi\\Components\\Optional\\Trash\\EmptyAction' => 
    array (
      0 => 
      array (
        'event' => 'action.post',
        'listener' => '\\Metayogi\\Listener\\RedirectListener',
        'priority' => -100,
      ),
    ),
  ),

  'rdf:type' => 'my:controllers',
);
