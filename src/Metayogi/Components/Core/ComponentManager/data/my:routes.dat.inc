<?php

$routes = array();

$routes[] = array (
  '_id' => '4ff758cbf311fecc5f00000c',
  'alias' => 'admin/components',
  'output' => 'html',
  'layout' => array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' => array (
    '_id' => '5015a6f2f311fe4627000000',
    '_ref' => 'my:views',
  ),
  'action' => '\\Metayogi\\Action\\ListAction',
  'controller' => array (
    '_id' => '4ff7588cf311fe1d0b00000a',
    '_ref' => 'my:controllers',
  ),
  'params' => array('pagesize' => '100'),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '5019b402f311fe920f000000',
  'alias' => 'admin/components/enable',
  'output' => 'html',
  'layout' => array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'action' => '\\Metayogi\\Components\\Core\\ComponentManager\\InstallAction',
  'controller' => array (
    '_id' => '4ff7588cf311fe1d0b00000a',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '5019b42bf311fe9d0f000002',
  'alias' => 'admin/components/disable',
  'output' => 'html',
  'layout' => array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'action' => '\\Metayogi\\Components\\Core\\ComponentManager\\UninstallAction',
  'controller' => array (
    '_id' => '4ff7588cf311fe1d0b00000a',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '50ef23e2f311fed67b000026',
  'alias' => 'admin/components/configure',
  'output' => 'html',
  'layout' => array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' => array (
    '_id' => '50ef2504f311fe0169000ff2',
    '_ref' => 'my:views',
  ),
  'action' => '\\Metayogi\\Components\\Core\\ComponentManager\\ConfigureAction',
  'controller' => array (
    '_id' => '4ff7588cf311fe1d0b00000a',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);
