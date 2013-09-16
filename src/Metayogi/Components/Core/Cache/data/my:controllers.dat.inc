<?php

$controllers = array();

$controllers[] = array (
  '_id' => '51bb86f2f311fef826000013',
  'name' => 'cache',
  'label' => 'Cache',
  'CRUDpath' => 'admin/cache',
  'instances' => '*.cache',
  'actions' => array (
    'BrowseAction' => '51bb86f2f311fef826000017',
    'ResetAction' => '51bb86f2f311fef826000018',
    'FlushAction' => '51bb86f2f311fef82600001a',
  ),
  'listeners' => array (
    '\\Metayogi\\Components\\Core\\Cache\\ResetAction' => array (
      0 => array( 'event' => 'action.post', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
    ),
    '\\Metayogi\\Components\\Core\\Cache\\FlushAction' => array (
      0 => array( 'event' => 'action.post', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
    ),
  ),
  'rdf:type' => 'my:controllers',
);