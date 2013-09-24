<?php

$controllers = array();

$controllers[] = array (
  '_id' => '4ff7588cf311fe1d0b00000a',
  'name' => 'component',
  'label' => 'Component',
  'instances' => 'my:components',
  'CRUDpath' => 'admin/components',
  'actions' => array (
    'InstallAction' => '5019b402f311fe920f000000',
    'UninstallAction' => '5019b42bf311fe9d0f000002',
    'ListAction' => '4ff758cbf311fecc5f00000c',
    'ConfigureAction' => '50ef23e2f311fed67b000026',
  ),
  'listeners' => array (
    '\\Metayogi\\Action\\ListAction' => array (
      0 => array( 'event' => 'action.pre', 'listener' => '\\Metayogi\\Components\\Core\\ComponentManager\\ComponentListener'),
      1 => array( 'event' => 'action.pre', 'listener' => '\\Metayogi\\Listener\\FilterListener'),      
    ),
    '\\Metayogi\\Components\\Core\\ComponentManager\\InstallAction' => array (
      0 => array( 'event' => 'action.post', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
    ),
    '\\Metayogi\\Components\\Core\\ComponentManager\\UninstallAction' => array (
      0 => array( 'event' => 'action.post', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
    ),
  ),
  'rdf:type' => 'my:controllers',
);