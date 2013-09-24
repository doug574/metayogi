<?php

$routes = array();

/*
* Views
*/

$routes[] = array (
  '_id' => '4ecd580b6c10bad50a000000',
  'alias' => 'admin/views',
  'output' => 'html',
  'layout' => array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' =>  array (
    '_id' => '4ed5349c6c10baff2f050000',
    '_ref' => 'my:views',
  ),
  'action' => '\\Metayogi\\Action\\ListAction',
  'controller' =>  array (
    '_id' => '4ecd57ac6c10bad80a010000',
    '_ref' => 'my:controllers',
  ),
  'params' => array (
    'pagesize' => '20',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '4ecd5e2b6c10bad80a020000',
  'alias' => 'admin/views/display',
  'output' => 'html',
  'layout' =>  array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' =>  array (
    '_id' => '4f6ea0a1f311fe7372000005',
    '_ref' => 'my:views',
  ),
  'action' => '\\Metayogi\\Action\\LoadAction',
  'controller' =>  array (
    '_id' => '4ecd57ac6c10bad80a010000',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '4ecd5e476c10bad40a000000',
  'alias' => 'admin/views/add',
  'output' => 'html',
  'layout' =>  array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' =>  array (
    '_id' => '4fdb74b9f311fece7e000008',
    '_ref' => 'my:views',
  ),
  'action' => '\\Metayogi\\Action\\CreateAction',
  'controller' =>  array (
    '_id' => '4ecd57ac6c10bad80a010000',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '4ed5e7896c10ba0230060000',
  'alias' => 'admin/views/update',
  'output' => 'html',
  'layout' =>  array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' =>  array (
    '_id' => '4fdb74b9f311fece7e000008',
    '_ref' => 'my:views',
  ),
  'action' => '\\Metayogi\\Action\\EditAction',
  'controller' =>  array (
    '_id' => '4ecd57ac6c10bad80a010000',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '4ed5e7aa6c10ba05300c0000',
  'alias' => 'admin/views/delete',
  'output' => 'html',
  'layout' =>  array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'action' => '\\Metayogi\\Action\\DeleteAction',
  'controller' =>  array (
    '_id' => '4ecd57ac6c10bad80a010000',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

/*
* Fieldsets
*/

$routes[] = array (
  '_id' => '51d54002f311fe7509586a61',
  'alias' => 'admin/fieldsets',
  'output' => 'html',
  'action' => '\\Metayogi\\Action\\ListAction',
  'layout' => array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' => array (
    '_id' => '51d54002f311fe7509586a5e',
    '_ref' => 'my:views',
  ),
  'controller' => array (
    '_id' => '51d54002f311fe7509586a5d',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '51d54002f311fe7509586a62',
  'alias' => 'admin/fieldsets/add',
  'output' => 'html',
  'action' => '\\Metayogi\\Action\\CreateAction',
  'layout' => array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' => array (
    '_id' => '51d54002f311fe7509586a60',
    '_ref' => 'my:views',
  ),
  'controller' => array (
    '_id' => '51d54002f311fe7509586a5d',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '51d54002f311fe7509586a63',
  'alias' => 'admin/fieldsets/update',
  'output' => 'html',
  'action' => '\\Metayogi\\Action\\EditAction',
  'layout' => array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' => array (
    '_id' => '51d54002f311fe7509586a60',
    '_ref' => 'my:views',
  ),
  'controller' => array (
    '_id' => '51d54002f311fe7509586a5d',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '51d54002f311fe7509586a64',
  'alias' => 'admin/fieldsets/delete',
  'output' => 'html',
  'action' => '\\Metayogi\\Action\\DeleteAction',
  'layout' => array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'controller' => array (
    '_id' => '51d54002f311fe7509586a5d',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '51d54002f311fe7509586a65',
  'alias' => 'admin/fieldsets/display',
  'output' => 'html',
  'action' => '\\Metayogi\\Action\\LoadAction',
  'layout' => array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' => array (
    '_id' => '51d54002f311fe7509586a5f',
    '_ref' => 'my:views',
  ),
  'controller' => array (
    '_id' => '51d54002f311fe7509586a5d',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);