<?php

$controllers = array();

$controllers[] = array (
  '_id' => '5049165ff311feff6e000002',
  'name' => 'class',
  'label' => 'Classes',
  'instances' => 'rdfs:classes',
  'CRUDpath' => 'admin/classes',
  'hooks' => array (
    'myCreateAction' => array (
      'pre' => array('myQnameSaveHook'),
      'post' => array('myModelCreateHook'),
    ),
    'myEditAction' => array (
      'pre' => array('myQnameSaveHook', 'myModelUpdateHook'),
      'post' => array('myModelEditHook', 'myCacheEditHook'),
    ),
    'myDeleteAction' => array (
      'pre' => array('myModelDeleteHook', 'myCacheDeleteHook'),
    ),
  ),
  'actions' => array (
    'ListAction' => '50491711f311fefb6e000008',
    'CreateAction' => '50491740f311fefb6e000009',
    'EditAction' => '50491758f311fefc6e000005',
    'DeleteAction' => '5049176ef311fefa6e000006',
    'LoadAction' => '50491780f311feff6e000003',
  ),
  'listeners' => array (
    '\\Metayogi\\Action\\ListAction' => array (
      0 => array( 'event' => 'action.pre', 'listener' => '\\Metayogi\\Listener\\FilterListener'),
    ),
    '\\Metayogi\\Action\\DeleteAction' => array (
      0 => array( 'event' => 'action.post', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
      1 => array( 'event' => 'action.post', 'listener' => '\\Metayogi\\Components\\Core\\ModelWizard\\ModelListener', 'method' => 'onDelete'),
    ),
    '\\Metayogi\\Action\\CreateAction' => array (
      0 => array( 'event' => 'action.post', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
      1 => array( 'event' => 'action.cancel', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
      2 => array( 'event' => 'form.valid', 'listener' => '\\Metayogi\\Components\\Core\\ModelWizard\\QnameListener'),
      3 => array( 'event' => 'action.post', 'listener' => '\\Metayogi\\Components\\Core\\ModelWizard\\ModelListener', 'method' => 'onCreate'),
    ),
    '\\Metayogi\\Action\\EditAction' => array (
      0 => array( 'event' => 'action.post', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
      1 => array( 'event' => 'action.cancel', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
      2 => array( 'event' => 'form.valid', 'listener' => '\\Metayogi\\Components\\Core\\ModelWizard\\QnameListener'),
      3 => array( 'event' => 'action.post', 'listener' => '\\Metayogi\\Components\\Core\\ModelWizard\\ModelListener', 'method' => 'onUpdate'),
    ),
  ),
  'rdf:type' => 'my:controllers',
);

$controllers[] = array (
  '_id' => '5047cec7f311fefb6e000005',
  'name' => 'property',
  'label' => 'Properties',
  'instances' => 'rdf:properties',
  'CRUDpath' => 'admin/properties',
  'hooks' => array (
    'myCreateAction' => array (
      'pre' => array ('myQnameSaveHook'),
    ),
    'myEditAction' => array (
      'pre' => array ('myQnameSaveHook'),
    ),
  ),
  'actions' => array (
    'ListAction' => '5047cfe7f311fecf7c000000',
    'CreateAction' => '5047cffcf311fefe6e000000',
    'EditAction' => '5047d010f311fefd6e000003',
    'DeleteAction' => '5047d021f311fefb6e000006',
    'LoadAction' => '5047d02ff311fefc6e000003',
  ),
  'listeners' => array (
    '\\Metayogi\\Action\\ListAction' => array (
      0 => array( 'event' => 'action.pre', 'listener' => '\\Metayogi\\Listener\\FilterListener'),
    ),
    '\\Metayogi\\Action\\DeleteAction' => array (
      0 => array( 'event' => 'action.post', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
    ),
    '\\Metayogi\\Action\\CreateAction' => array (
      0 => array( 'event' => 'action.post', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
      1 => array( 'event' => 'action.cancel', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
      2 => array( 'event' => 'form.valid', 'listener' => '\\Metayogi\\Components\\Core\\ModelWizard\\QnameListener'),
    ),
    '\\Metayogi\\Action\\EditAction' => array (
      0 => array( 'event' => 'action.post', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
      1 => array( 'event' => 'action.cancel', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
      2 => array( 'event' => 'form.valid', 'listener' => '\\Metayogi\\Components\\Core\\ModelWizard\\QnameListener'),
    ),
  ),

  'rdf:type' => 'my:controllers',
);

$controllers[] = array (
  '_id' => '5047c617f311feff6e000000',
  'name' => 'namespace',
  'label' => 'Namespace',
  'instances' => 'my:namespaces',
  'CRUDpath' => 'admin/namespaces',
  'actions' => array (
    'ListAction' => '5047c755f311fefa6e000002',
    'CreateAction' => '5047c7caf311fefd6e000000',
    'EditAction' => '5047c7e0f311fefb6e000004',
    'DeleteAction' => '5047c7eff311fefc6e000001',
    'LoadAction' => '5047c804f311fefa6e000003',
  ),
  'listeners' => array (
    '\\Metayogi\\Action\\ListAction' => array (
      0 => array( 'event' => 'action.pre', 'listener' => '\\Metayogi\\Listener\\FilterListener'),
    ),
    '\\Metayogi\\Action\\DeleteAction' => array (
      0 => array( 'event' => 'action.post', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
    ),
    '\\Metayogi\\Action\\CreateAction' => array (
      0 => array( 'event' => 'action.post', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
      1 => array( 'event' => 'action.cancel', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
    ),
    '\\Metayogi\\Action\\EditAction' => array (
      0 => array( 'event' => 'action.post', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
      1 => array( 'event' => 'action.cancel', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
    ),
  ),
  'rdf:type' => 'my:controllers',
);

$controllers[] = array (
  '_id' => '4ec6a9e26c10ba714e100000',
  'label' => 'Enumeration',
  'name' => 'enumeration',
  'instances' => 'my:enumerations',
  'CRUDpath' => 'admin/enums',
  'actions' => array (
    'ListAction' => '4ec6aafe6c10bad8450d0000',
    'CreateAction' => '4ec6ac246c10baf5490f0000',
    'EditAction' => '4ec6ac106c10baeb45150000',
    'DeleteAction' => '4ec6ac5a6c10ba714e110000',
    'LoadAction' => '4ec6ac356c10baeb45160000',
  ),
  'listeners' => array (
    '\\Metayogi\\Action\\ListAction' => array (
      0 => array( 'event' => 'action.pre', 'listener' => '\\Metayogi\\Listener\\FilterListener'),
    ),
    '\\Metayogi\\Action\\DeleteAction' => array (
      0 => array( 'event' => 'action.post', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
    ),
    '\\Metayogi\\Action\\CreateAction' => array (
      0 => array( 'event' => 'action.post', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
      1 => array( 'event' => 'action.cancel', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
    ),
    '\\Metayogi\\Action\\EditAction' => array (
      0 => array( 'event' => 'action.post', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
      1 => array( 'event' => 'action.cancel', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
    ),
  ),
  'rdf:type' => 'my:controllers',
);
