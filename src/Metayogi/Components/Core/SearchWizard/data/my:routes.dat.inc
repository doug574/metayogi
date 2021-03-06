<?php

$routes = array();

$routes[] = array (
  '_id' => '50787ef80de404135e000011',
  'alias' => 'search',
  'output' => 'html',
  'layout' => array (
    '_id' => '506be69e0de404f30d00001c',
    '_ref' => 'my:layouts',
  ),
  'view' => array (
    '_id' => '50787f590de4042d630000b0',
    '_ref' => 'my:views',
  ),
  'action' => '\\Metayogi\\Search\\SearchAction',
  'controller' => array (
    '_id' => '506d99cb0de404f30d000055',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);


$routes[] = array (
  '_id' => '504fb638f311fed94d00000a',
  'alias' => 'admin/indexes',
  'action' => '\\Metayogi\\Action\\ListAction',
  'layout' => array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts'
  ),
  'output' => 'html',
  'view' => array (
    '_id' => '50502fa4f311fee57b000000',
    '_ref' => 'my:views',
  ),
  'controller' => array (
    '_id' => '50502f1ef311fee77b000000',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '504fb638f311fed94d00000b',
  'alias' => 'admin/indexes/add',
  'action' => '\\Metayogi\\Action\\CreateAction',
  'layout' => array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts'
  ),
  'output' => 'html',
  'view' => array (
    '_id' => '505030adf311feff7b000000',
    '_ref' => 'my:views',
  ),
  'controller' => array (
    '_id' => '50502f1ef311fee77b000000',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '504fb638f311fed94d00000c',
  'alias' => 'admin/indexes/update',
  'action' => '\\Metayogi\\Action\\EditAction',
  'layout' => array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts'
  ),
  'output' => 'html',
  'view' => array (
    '_id' => '505030adf311feff7b000000',
    '_ref' => 'my:views',
  ),
  'controller' => array (
    '_id' => '50502f1ef311fee77b000000',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '504fb638f311fed94d00000d',
  'alias' => 'admin/indexes/delete',
  'action' => '\\Metayogi\\Action\\DeleteAction',
  'layout' => array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts'
  ),
  'output' => 'html',
  'controller' => array (
    '_id' => '50502f1ef311fee77b000000',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
); 

$routes[] = array (
  '_id' => '504fb638f311fed94d00000e',
  'alias' => 'admin/indexes/display',
  'action' => '\\Metayogi\\Action\\LoadAction',
  'layout' => array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts'
  ),
  'output' => 'html',
  'controller' => array (
    '_id' => '50502f1ef311fee77b000000',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

/* Search Forms */

$routes[] = array (
  '_id' => '506d99cb0de404f30d000059',
  'alias' => 'admin/sforms',
  'output' => 'html',
  'action' => '\\Metayogi\\Action\\ListAction',
  'layout' => array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts'
  ),
  'view' => array (
    '_id' => '506d99cb0de404f30d000056',
    '_ref' => 'my:views',
  ),
  'controller' => array (
    '_id' => '506d99cb0de404f30d000055',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '506d99cb0de404f30d00005a',
  'alias' => 'admin/sforms/add',
  'output' => 'html',
  'action' => '\\Metayogi\\Action\\CreateAction',
  'layout' => array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts'
  ),
  'view' => array (
    '_id' => '506d99cb0de404f30d000058',
    '_ref' => 'my:views',
  ),
  'controller' => array (
    '_id' => '506d99cb0de404f30d000055',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '506d99cb0de404f30d00005b',
  'alias' => 'admin/sforms/update',
  'output' => 'html',
  'action' => '\\Metayogi\\Action\\EditAction',
  'layout' => array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts'
  ),
  'view' => array (
    '_id' => '506d99cb0de404f30d000058',
    '_ref' => 'my:views',
  ),
  'controller' => array (
    '_id' => '506d99cb0de404f30d000055',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '506d99cb0de404f30d00005c',
  'alias' => 'admin/sforms/delete',
  'output' => 'html',
  'action' => '\\Metayogi\\Action\\DeleteAction',
  'layout' => array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts'
  ),
  'controller' => array (
    '_id' => '506d99cb0de404f30d000055',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '506d99cb0de404f30d00005d',
  'alias' => 'admin/sforms/display',
  'output' => 'html',
  'action' => '\\Metayogi\\Action\\LoadAction',
  'layout' => array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts'
  ),
  'view' => array (
    '_id' => '506d99cb0de404f30d000057',
    '_ref' => 'my:views',
  ),
  'controller' => array (
    '_id' => '506d99cb0de404f30d000055',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '50ed5066f311fe3b49000058',
  'alias' => 'admin/reindex',
  'output' => 'html',
  'action' => '\\Metayogi\\Components\\Core\\Search\\ReindexAction',
  'layout' => array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts'
  ),
  'controller' => array (
    '_id' => '506d99cb0de404f30d000055',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);
