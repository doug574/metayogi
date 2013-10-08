<?php

$controllers = array();

$controllers[] = array (
  '_id' => '4ff7588cf311fe1d0b00000a',
  'name' => 'component',
  'label' => 'Component',
  'collection' => 'my:components',
  'CRUDpath' => 'admin/components',
  'actions' => array (
    'InstallAction' => '5019b402f311fe920f000000',
    'UninstallAction' => '5019b42bf311fe9d0f000002',
    'ListAction' => '4ff758cbf311fecc5f00000c',
    'ConfigureAction' => '50ef23e2f311fed67b000026',
  ),
  'listeners' => array (
    'model' => array (
      '5254561af311fea57a5a83bd' => array( 'action' => '\\Metayogi\\Action\\ListAction', 'event' => 'action.pre', 'listener' => '\\Metayogi\\Components\\Core\\ComponentManager\\ComponentListener'),
      '5254561ff311fea17ae6ddad' => array( 'action' => '\\Metayogi\\Action\\ListAction', 'event' => 'action.pre', 'listener' => '\\Metayogi\\Listener\\FilterListener'),      
      '52545624f311fe9e7a36d6ce' => array( 'action' => '\\Metayogi\\Components\\Core\\ComponentManager\\InstallAction', 'event' => 'action.post', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
      '52545628f311fea57a5b8d87' => array( 'action' => '\\Metayogi\\Components\\Core\\ComponentManager\\UninstallAction', 'event' => 'action.post', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
    ),
  ),
  'rdf:type' => 'my:controllers',
);
