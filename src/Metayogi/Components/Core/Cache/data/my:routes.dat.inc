<?php

$routes = array();

$routes[] = array (
  '_id' => '51bb86f2f311fef826000017',
  'alias' => 'admin/cache',
  'output' => 'html',
  'action' => '\\Metayogi\\Components\\Core\\Cache\\BrowseAction',
  'layout' => array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' => array (
    '_id' => '51bb86f2f311fef826000014',
    '_ref' => 'my:views',
  ),
  'controller' => array (
    '_id' => '51bb86f2f311fef826000013',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '51bb86f2f311fef826000018',
  'alias' => 'admin/cache/reset',
  'output' => 'html',
  'action' => '\\Metayogi\\Components\\Core\\Cache\\ResetAction',
  'layout' => array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'controller' => array (
    '_id' => '51bb86f2f311fef826000013',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '51bb86f2f311fef82600001a',
  'alias' => 'admin/cache/flush',
  'output' => 'html',
  'action' => '\\Metayogi\\Components\\Core\\Cache\\FlushAction',
  'layout' => array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'controller' => array (
    '_id' => '51bb86f2f311fef826000013',
    '_ref' => 'my:controllers',
  ),
  'params' => array (
    'cache' => '',
  ),
  'rdf:type' => 'my:routes',
);