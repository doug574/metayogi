<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

$routes = array();

$routes[] = array(
  '_id' => '504a6d90f311fefa6e000009',
  'alias' => 'admin/controllers',
  'output' => 'html',
  'action' => '\\Metayogi\\Action\\ListAction',
  'layout' => array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' => array (
    '_id' => '504a6ef6f311fe016f000004',
    '_ref' => 'my:views',
  ),
  'controller' => array (
    '_id' => '504a6df2f311fefb6e00000c',
    '_ref' => 'my:controllers',
  ),
  'query' => array (
    'behaviours' => 1,
  ),
  'rdf:type' => 'my:routes',
);
/*
$routes[] = array(
  '_id' => '504f6478f311fed94d000000',
  'alias' => 'admin/controllers/add',
  'output' => 'html',
  'layout' => array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' => array (
    '_id' => '504a70daf311fe006f000003',
    '_ref' => 'my:views',
  ),
  'action' => '\\Metayogi\\Action\\CreateAction',
  'controller' => array (
    '_id' => '504a6df2f311fefb6e00000c',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);
*/
$routes[] = array(
  '_id' => '504a6daaf311feff6e000005',
  'alias' => 'admin/controllers/update',
  'output' => 'html',
  'layout' => array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' => array (
    '_id' => '504a70daf311fe006f000003',
    '_ref' => 'my:views',
  ),
  'action' => '\\Metayogi\\Action\\EditAction',
  'controller' => array (
    '_id' => '504a6df2f311fefb6e00000c',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array(
  '_id' => '504a6e66f311fefe6e000008',
  'alias' => 'admin/controllers/display',
  'output' => 'html',
  'layout' => array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' => array (
    '_id' => '504a735cf311fefd6e000005',
    '_ref' => 'my:views',
  ),
  'action' => '\\Metayogi\\Action\\LoadAction',
  'controller' => array (
    '_id' => '504a6df2f311fefb6e00000c',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

/*
$routes[] = array(
  '_id' => '505214eff311fee27b000000',
  'alias' => 'admin/controllers/delete',
  'output' => 'html',
  'layout' => array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'action' => '\\Metayogi\\Action\\DeleteAction',
  'controller' => array (
    '_id' => '504a6df2f311fefb6e00000c',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);
*/