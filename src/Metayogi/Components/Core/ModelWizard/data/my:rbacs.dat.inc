<?php

$rbacs = array();

$rbacs[] = array (
  '_id' => '51cd46a3f311feaa08734dd1',
  'controller' => 'rdfs:classes',
  'role' => array (
    0 => 'Administrator',
    1 => 'Designer',
  ),
  'actions' => array (
    0 => 'myCreateAction',
    1 => 'myDeleteAction',
    2 => 'myEditAction',
    3 => 'myListAction',
    4 => 'myLoadAction',
  ),
  'rdf:type' => 'my:rbacs',
);

$rbacs[] = array (
  '_id' => '51cd470df311fea80809e45a',
  'controller' => 'rdfs:classes',
  'role' => array (
    0 => 'Editor',
    1 => 'User',
    2 => 'Anonymous',
  ),
  'actions' => array (
    0 => 'myLoadAction',
  ),
  'rdf:type' => 'my:rbacs',
);

$rbacs[] = array (
  '_id' => '51cd4766f311fea70889bc59',
  'controller' => 'rdf:properties',
  'role' => array (
    0 => 'Administrator',
    1 => 'Designer',
  ),
  'actions' => array (
    0 => 'myCreateAction',
    1 => 'myDeleteAction',
    2 => 'myEditAction',
    3 => 'myListAction',
    4 => 'myLoadAction',
  ),
  'rdf:type' => 'my:rbacs',
);

$rbacs[] = array (
  '_id' => '51cd493df311feaa086be912',
  'controller' => 'rdf:properties',
  'role' => array (
    0 => 'Editor',
    1 => 'User',
    2 => 'Anonymous',
  ),
  'actions' => array (
    0 => 'myLoadAction',
  ),
  'rdf:type' => 'my:rbacs',
);

$rbacs[] = array (
  '_id' => '51cd4961f311feae08ce10b3',
  'controller' => 'my:namespaces',
  'role' => array (
    0 => 'Administrator',
    1 => 'Designer',
  ),
  'actions' => array (
    0 => 'myCreateAction',
    1 => 'myDeleteAction',
    2 => 'myEditAction',
    3 => 'myListAction',
    4 => 'myLoadAction',
  ),
  'rdf:type' => 'my:rbacs',
);

$rbacs[] = array (
  '_id' => '51cd4979f311fea708f13906',
  'controller' => 'my:namespaces',
  'role' => array (
    0 => 'Editor',
    1 => 'User',
    2 => 'Anonymous',
  ),
  'actions' => array (
    0 => 'myLoadAction',
  ),
  'rdf:type' => 'my:rbacs',
);

$rbacs[] = array (
  '_id' => '51cd4cb2f311feae08c6a1cf',
  'controller' => 'my:enumerations',
  'role' => array (
    0 => 'Administrator',
    1 => 'Designer',
  ),
  'actions' => array (
    0 => 'myCreateAction',
    1 => 'myDeleteAction',
    2 => 'myEditAction',
    3 => 'myListAction',
    4 => 'myLoadAction',
  ),
  'rdf:type' => 'my:rbacs',
);

$rbacs[] = array (
  '_id' => '51cd4cdcf311fea7086c02dd',
  'controller' => 'my:enumerations',
  'role' => array (
    0 => 'Editor',
    1 => 'User',
    2 => 'Anonymous',
  ),
  'actions' => array (
    0 => 'myLoadAction',
  ),
  'rdf:type' => 'my:rbacs',
);