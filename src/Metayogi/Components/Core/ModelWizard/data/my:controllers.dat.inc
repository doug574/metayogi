<?php

$controllers = array();

$controllers[] = array (
  '_id' => '5049165ff311feff6e000002',
  'name' => 'class',
  'label' => 'Classes',
  'collection' => 'rdfs:classes',
  'CRUDpath' => 'admin/classes',
  'actions' => array (
    'ListAction' => 'admin/classes',
    'CreateAction' => 'admin/classes/add',
    'EditAction' => 'admin/classes/update',
    'DeleteAction' => 'admin/classes/delete',
    'LoadAction' => 'admin/classes/display',
  ),
  'listeners' => array (
    'model' => array (
      '52545f2bf311fea07aed47bf' => array( 'action' => '\\Metayogi\\Action\\ListAction', 'event' => 'action.pre', 'listener' => '\\Metayogi\\Listener\\FilterListener'),
      '52545f2ff311fea37aa3b8ea' => array( 'action' => '\\Metayogi\\Action\\DeleteAction', 'event' => 'action.post', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
      '52545f3cf311fea27a8a050a' => array( 'action' => '\\Metayogi\\Action\\DeleteAction', 'event' => 'action.post', 'listener' => '\\Metayogi\\Components\\Core\\ModelWizard\\ModelListener', 'method' => 'onDelete'),
      '52545f42f311fea07aa66955' => array( 'action' => '\\Metayogi\\Action\\CreateAction', 'event' => 'action.post', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
      '52545f46f311fea37a317f43' => array( 'action' => '\\Metayogi\\Action\\CreateAction', 'event' => 'action.cancel', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
      '52545f4bf311fea27a87a339' => array( 'action' => '\\Metayogi\\Action\\CreateAction', 'event' => 'form.valid', 'listener' => '\\Metayogi\\Components\\Core\\ModelWizard\\QnameListener'),
      '52545f4ff311fea07a264fe8' => array( 'action' => '\\Metayogi\\Action\\CreateAction', 'event' => 'action.post', 'listener' => '\\Metayogi\\Components\\Core\\ModelWizard\\ModelListener', 'method' => 'onCreate'),
      '52545f56f311fea37a0498bc' => array( 'action' => '\\Metayogi\\Action\\EditAction', 'event' => 'action.post', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
      '52545f63f311fea47ada0a03' => array( 'action' => '\\Metayogi\\Action\\EditAction', 'event' => 'action.cancel', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
      '52545f6ff311fea57ad1bb9d' => array( 'action' => '\\Metayogi\\Action\\EditAction', 'event' => 'form.valid', 'listener' => '\\Metayogi\\Components\\Core\\ModelWizard\\QnameListener'),
      '52545f73f311fea47a2495c1' => array( 'action' => '\\Metayogi\\Action\\EditAction', 'event' => 'action.post', 'listener' => '\\Metayogi\\Components\\Core\\ModelWizard\\ModelListener', 'method' => 'onUpdate'),
    ),
  ),
  'rdf:type' => 'my:controllers',
);

$controllers[] = array (
  '_id' => '5047cec7f311fefb6e000005',
  'name' => 'property',
  'label' => 'Properties',
  'collection' => 'rdf:properties',
  'CRUDpath' => 'admin/properties',
  'actions' => array (
    'ListAction' => 'admin/properties',
    'CreateAction' => 'admin/properties/add',
    'EditAction' => 'admin/properties/update',
    'DeleteAction' => 'admin/properties/delete',
    'LoadAction' => 'admin/properties/load',
  ),
  'listeners' => array (
    'model' => array (
      '52545d19f311fea17ada48ff' => array( 'action' => '\\Metayogi\\Action\\ListAction', 'event' => 'action.pre', 'listener' => '\\Metayogi\\Listener\\FilterListener'),
      '52545d1ef311fe9e7a7e48c5' => array( 'action' => '\\Metayogi\\Action\\DeleteAction', 'event' => 'action.post', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
      '52545d24f311fe9f7a712836' => array( 'action' => '\\Metayogi\\Action\\CreateAction', 'event' => 'action.post', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
      '52545d28f311fea17a2daea3' => array( 'action' => '\\Metayogi\\Action\\CreateAction', 'event' => 'action.cancel', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
      '52545d2df311fe9e7a30d09d' => array( 'action' => '\\Metayogi\\Action\\CreateAction', 'event' => 'form.valid', 'listener' => '\\Metayogi\\Components\\Core\\ModelWizard\\QnameListener'),
      '52545d31f311fea47a0866d4' => array( 'action' => '\\Metayogi\\Action\\EditAction', 'event' => 'action.post', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
      '52545d3bf311fe9c3eb19cd1' => array( 'action' => '\\Metayogi\\Action\\EditAction', 'event' => 'action.cancel', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
      '52545d3ff311fea57ab0f318' => array( 'action' => '\\Metayogi\\Action\\EditAction', 'event' => 'form.valid', 'listener' => '\\Metayogi\\Components\\Core\\ModelWizard\\QnameListener'),
    ),
  ),
  'rdf:type' => 'my:controllers',
);

$controllers[] = array (
  '_id' => '5047c617f311feff6e000000',
  'name' => 'namespace',
  'label' => 'Namespace',
  'collection' => 'my:namespaces',
  'CRUDpath' => 'admin/namespaces',
  'actions' => array (
    'ListAction' => 'admin/namespaces',
    'CreateAction' => 'admin/namespaces/add',
    'EditAction' => 'admin/namespaces/update',
    'DeleteAction' => 'admin/namespaces/delete',
    'LoadAction' => 'admin/namespaces/display',
  ),
  'listeners' => array (
    'model' => array (
      '52545923f311fea47ad61fa6' => array( 'action' => '\\Metayogi\\Action\\ListAction', 'event' => 'action.pre', 'listener' => '\\Metayogi\\Listener\\FilterListener'),
      '52545930f311fea37a68b657' => array( 'action' => '\\Metayogi\\Action\\DeleteAction', 'event' => 'action.post', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
      '52545934f311fea27a6ab4c5' => array( 'action' => '\\Metayogi\\Action\\CreateAction', 'event' => 'action.post', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
      '52545944f311fea07a3d84fa' => array( 'action' => '\\Metayogi\\Action\\CreateAction', 'event' => 'action.cancel', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
      '52545949f311fea37ab2010a' => array( 'action' => '\\Metayogi\\Action\\EditAction', 'event' => 'action.post', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
      '5254594ef311fea27acbbba4' => array( 'action' => '\\Metayogi\\Action\\EditAction', 'event' => 'action.cancel', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
    ),
  ),
  'rdf:type' => 'my:controllers',
);

$controllers[] = array (
  '_id' => '4ec6a9e26c10ba714e100000',
  'label' => 'Enumeration',
  'name' => 'enumeration',
  'collection' => 'my:enumerations',
  'CRUDpath' => 'admin/enums',
  'actions' => array (
    'ListAction' => 'admin/enums',
    'CreateAction' => 'admin/enums/add',
    'EditAction' => 'admin/enums/update',
    'DeleteAction' => 'admin/enums/delete',
    'LoadAction' => 'admin/enums/display',
  ),
  'listeners' => array (
    'model' => array (
      '52545b23f311fea07a989c9d' => array( 'action' => '\\Metayogi\\Action\\ListAction', 'event' => 'action.pre', 'listener' => '\\Metayogi\\Listener\\FilterListener'),
      '52545b28f311fea37a061eef' => array( 'action' => '\\Metayogi\\Action\\DeleteAction', 'event' => 'action.post', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
      '52545b2cf311fea27a35f874' => array( 'action' => '\\Metayogi\\Action\\CreateAction', 'event' => 'action.post', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
      '52545b31f311fea07aaf27c7' => array( 'action' => '\\Metayogi\\Action\\CreateAction', 'event' => 'action.cancel', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
      '52545b36f311fea37a11229a' => array( 'action' => '\\Metayogi\\Action\\EditAction', 'event' => 'action.post', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
      '52545b3bf311fea27ac4b79e' => array( 'action' => '\\Metayogi\\Action\\EditAction', 'event' => 'action.cancel', 'listener' => '\\Metayogi\\Listener\\RedirectListener', 'priority' => -100),
    ),
  ),
  'rdf:type' => 'my:controllers',
);
