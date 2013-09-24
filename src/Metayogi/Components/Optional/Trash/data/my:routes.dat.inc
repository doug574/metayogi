<?php

$routes = array();

$routes[] = array (
  '_id' => '4ed5c9e06c10ba00300c0000',
  'alias' => 'admin/trash',
  'output' => 'html',
  'layout' =>  array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' => array (
    '_id' => '4ffafcbbf311fe273a000000',
    '_ref' => 'my:views',
  ),
  'action' => '\\Metayogi\\Action\\ListAction',
  'controller' => array (
    '_id' => '4ed495226c10baff2f020000',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '4ed5d2996c10ba05300a0000',
  'alias' => 'admin/trash/recover',
  'output' => 'html',
  'layout' =>  array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'action' => '\\Metayogi\\Components\\Optional\\Trash\\RecoverAction',
  'controller' => array (
    '_id' => '4ed495226c10baff2f020000',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '4ee3b13f6c10bacd0b020000',
  'alias' => 'admin/trash/purge',
  'output' => 'html',
  'layout' =>  array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'action' => '\\Metayogi\\Components\\Optional\\Trash\\PurgeAction',
  'controller' => array (
    '_id' => '4ed495226c10baff2f020000',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '4f78d340f311fe6725000000',
  'alias' => 'admin/trash/empty',
  'output' => 'html',
  'layout' =>  array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'action' => '\\Metayogi\\Components\\Optional\\Trash\\EmptyAction',
  'controller' => array (
    '_id' => '4ed495226c10baff2f020000',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);
