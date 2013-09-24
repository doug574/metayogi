<?php

$routes = array();

$routes[] = array (
  '_id' => '4ec9edc96c10bae14b010000',
  'alias' => 'admin/menus',
  'output' => 'html',
  'layout' => array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' => array (
    '_id' => '4ed538806c10ba0430040000',
    '_ref' => 'my:views',
  ),
  'action' => '\\Metayogi\\Action\\ListAction',
  'controller' => array (
    '_id' => '4ebac9fe6c10ba4975000000',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '4ec9ee2b6c10badd5b000000',
  'alias' => 'admin/menus/add',
  'output' => 'html',
  'layout' => array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' => array (
    '_id' => '4fcd2254f311fef10a000000',
    '_ref' => 'my:views',
  ),
  'action' => '\\Metayogi\\Action\\CreateAction',
  'controller' => array (
    '_id' => '4ebac9fe6c10ba4975000000',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$route[] = array (
  '_id' => '4ecddb4b6c10bada0a040000',
  'alias' => 'admin/menus/display',
  'output' => 'html',
  'layout' => array (
    '_id' =>'4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' => array (
    '_id' => '4edc4cea6c10baf169070000',
    '_ref' => 'my:views',
  ),
  'action' => '\\Metayogi\\Action\\LoadAction',
  'controller' => array (
    '_id' => '4ebac9fe6c10ba4975000000',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$route[] = array (
  '_id' => '4ecddb8e6c10badb0a030000',
  'alias' => 'admin/menus/update',
  'output' => 'html',
  'layout' => array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' => array (
    '_id' => '4fcd2254f311fef10a000000',
    '_ref' => 'my:views',
  ),
  'action' => '\\Metayogi\\Action\\EditAction',
  'controller' => array (
    '_id' => '4ebac9fe6c10ba4975000000',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '4ecddb9d6c10bad90a020000',
  'alias' => 'admin/menus/delete',
  'output' => 'html',
  'layout' => array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'action' => '\\Metayogi\\Action\\DeleteAction',
  'controller' => array (
    '_id' => '4ebac9fe6c10ba4975000000',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '500821dff311fee554000009',
  'alias' => 'admin/navbar',
  'output' => 'block',
  'view' => array (
    '_id' => '50081139f311feef27000005',
    '_ref' => 'my:views',
  ),
  'action' => '\\Metayogi\\Action\\LoadAction',
  'controller' => array (
    '_id' => '4ebac9fe6c10ba4975000000',
    '_ref' => 'my:controllers',
  ),
  'params' => array (
    'id' => '50080fcef311fef627000002',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '506bf26c0de404f50d000020',
  'alias' => 'public/navbar',
  'output' => 'block',
  'view' => array (
    '_id' => '506bf4db0de404f00d000025',
    '_ref' => 'my:views',
  ),
  'action' => '\\Metayogi\\Action\\LoadAction',
  'controller' => array (
    '_id' => '4ebac9fe6c10ba4975000000',
    '_ref' => 'my:controllers',
  ),
  'params' => array (
    'id' => '506bf1360de404f60d000029',
  ),
  'rdf:type' => 'my:routes',
);

