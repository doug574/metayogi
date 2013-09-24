<?php

$routes = array();


/* Routes for classes model */

$routes[] = array (
  '_id' => '50491711f311fefb6e000008',
  'alias' => 'admin/classes',
  'output' => 'html',
  'layout' =>  array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' =>  array (
    '_id' => '504917c2f311fefb6e00000a',
    '_ref' => 'my:views',
  ),
  'action' => '\\Metayogi\\Action\\ListAction',
  'controller' => array (
    '_id' => '5049165ff311feff6e000002',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '50491740f311fefb6e000009',
  'alias' => 'admin/classes/add',
  'output' => 'html',
  'layout' =>  array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' =>  array (
    '_id' => '50491882f311feff6e000004',
    '_ref' => 'my:views',
  ),
  'action' => '\\Metayogi\\Action\\CreateAction',
  'controller' => array (
    '_id' => '5049165ff311feff6e000002',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '50491758f311fefc6e000005',
  'alias' => 'admin/classes/update',
  'output' => 'html',
  'layout' =>  array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' =>  array (
    '_id' => '50491882f311feff6e000004',
    '_ref' => 'my:views',
  ),
  'action' => '\\Metayogi\\Action\\EditAction',
  'controller' => array (
    '_id' => '5049165ff311feff6e000002',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '5049176ef311fefa6e000006',
  'alias' => 'admin/classes/delete',
  'output' => 'html',
  'layout' =>  array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'action' => '\\Metayogi\\Action\\DeleteAction',
  'controller' => array (
    '_id' => '5049165ff311feff6e000002',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '50491780f311feff6e000003',
  'alias' => 'admin/classes/display',
  'output' => 'html',
  'layout' =>  array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' =>  array (
    '_id' => '5052600af311fefe7b000000',
    '_ref' => 'my:views',
  ),
  'action' => '\\Metayogi\\Action\\LoadAction',
  'controller' => array (
    '_id' => '5049165ff311feff6e000002',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);


/* Routes for properties model */

$routes[] = array (
  '_id' => '5047cfe7f311fecf7c000000',
  'alias' => 'admin/properties',
  'output' => 'html',
  'layout' =>  array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' =>  array (
    '_id' => '5047d0c0f311fefe6e000001',
    '_ref' => 'my:views',
  ),
  'action' => '\\Metayogi\\Action\\ListAction',
  'controller' => array (
    '_id' => '5047cec7f311fefb6e000005',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '5047cffcf311fefe6e000000',
  'alias' => 'admin/properties/add',
  'output' => 'html',
  'layout' =>  array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' =>  array (
    '_id' => '5047d16bf311fefb6e000007',
    '_ref' => 'my:views',
  ),
  'action' => '\\Metayogi\\Action\\CreateAction',
  'controller' => array (
    '_id' => '5047cec7f311fefb6e000005',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '5047d010f311fefd6e000003',
  'alias' => 'admin/properties/update',
  'output' => 'html',
  'layout' =>  array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' =>  array (
    '_id' => '5047d16bf311fefb6e000007',
    '_ref' => 'my:views',
  ),
  'action' => '\\Metayogi\\Action\\EditAction',
  'controller' => array (
    '_id' => '5047cec7f311fefb6e000005',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '5047d021f311fefb6e000006',
  'alias' => 'admin/properties/delete',
  'output' => 'html',
  'layout' =>  array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'action' => '\\Metayogi\\Action\\DeleteAction',
  'controller' => array (
    '_id' => '5047cec7f311fefb6e000005',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '5047d02ff311fefc6e000003',
  'alias' => 'admin/properties/display',
  'output' => 'html',
  'layout' =>  array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' =>  array (
    '_id' => '50525e84f311feff7b000003',
    '_ref' => 'my:views',
  ),
  'action' => '\\Metayogi\\Action\\LoadAction',
  'controller' => array (
    '_id' => '5047cec7f311fefb6e000005',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);


/* Routes for namespaces */

$routes[] = array (
  '_id' => '5047c755f311fefa6e000002',
  'alias' => 'admin/namespaces',
  'output' => 'html',
  'layout' =>  array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' =>  array (
    '_id' => '5047c965f311fefd6e000001',
    '_ref' => 'my:views',
  ),
  'action' => '\\Metayogi\\Action\\ListAction',
  'controller' => array (
    '_id' => '5047c617f311feff6e000000',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '5047c7caf311fefd6e000000',
  'alias' => 'admin/namespaces/add',
  'output' => 'html',
  'layout' =>  array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' =>  array (
    '_id' => '5047ca81f311fefd6e000002',
    '_ref' => 'my:views',
  ),
  'action' => '\\Metayogi\\Action\\CreateAction',
  'controller' => array (
    '_id' => '5047c617f311feff6e000000',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '5047c7e0f311fefb6e000004',
  'alias' => 'admin/namespaces/update',
  'output' => 'html',
  'layout' =>  array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' =>  array (
    '_id' => '5047ca81f311fefd6e000002',
    '_ref' => 'my:views',
  ),
  'action' => '\\Metayogi\\Action\\EditAction',
  'controller' => array (
    '_id' => '5047c617f311feff6e000000',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '5047c7eff311fefc6e000001',
  'alias' => 'admin/namespaces/delete',
  'output' => 'html',
  'layout' =>  array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'action' => '\\Metayogi\\Action\\DeleteAction',
  'controller' => array (
    '_id' => '5047c617f311feff6e000000',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '5047c804f311fefa6e000003',
  'alias' => 'admin/namespaces/display',
  'output' => 'html',
  'layout' =>  array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' =>  array (
    '_id' => '50526323f311fee97b000003',
    '_ref' => 'my:views',
  ),
  'action' => '\\Metayogi\\Action\\LoadAction',
  'controller' => array (
    '_id' => '5047c617f311feff6e000000',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);


/* Routes for enumerations */

$routes[] = array (
  '_id' => '4ec6aafe6c10bad8450d0000',
  'alias' => 'admin/enums',
  'output' => 'html',
  'layout' =>  array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' =>  array (
    '_id' => '4ed537c96c10ba0030070000',
    '_ref' => 'my:views',
  ),
  'action' => '\\Metayogi\\Action\\ListAction',
  'controller' => array (
    '_id' => '4ec6a9e26c10ba714e100000',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '4ec6ac246c10baf5490f0000',
  'alias' => 'admin/enums/add',
  'output' => 'html',
  'layout' =>  array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' =>  array (
    '_id' => '5069def90de404f00d000001',
    '_ref' => 'my:views',
  ),
  'action' => '\\Metayogi\\Action\\CreateAction',
  'controller' => array (
    '_id' => '4ec6a9e26c10ba714e100000',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '4ec6ac106c10baeb45150000',
  'alias' => 'admin/enums/update',
  'output' => 'html',
  'layout' =>  array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' =>  array (
    '_id' => '5069def90de404f00d000001',
    '_ref' => 'my:views',
  ),
  'action' => '\\Metayogi\\Action\\EditAction',
  'controller' => array (
    '_id' => '4ec6a9e26c10ba714e100000',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '4ec6ac356c10baeb45160000',
  'alias' => 'admin/enums/display',
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
  'controller' => array (
    '_id' => '4ec6a9e26c10ba714e100000',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '4ec6ac5a6c10ba714e110000',
  'alias' => 'admin/enums/delete',
  'output' => 'html',
  'layout' =>  array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'action' => '\\Metayogi\\Action\\DeleteAction',
  'controller' => array (
    '_id' => '4ec6a9e26c10ba714e100000',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

