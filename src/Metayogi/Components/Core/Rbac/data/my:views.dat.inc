<?php

$views = array();

/*
* Roles
*/

$views[] = array (
  '_id' => '5061341e0de404a520000095',
  'display' => '\\Metayogi\\Display\\TableDisplay',
  'decorators' => array (
    'pre' => array (
      0 => '\\Metayogi\\Decorator\\TitleDecorator',
      1 => '\\Metayogi\\Decorator\\CreateDecorator',
    ),
    'post' => array (
      0 => '\\Metayogi\\Decorator\\PagerDecorator',
      1 => '\\Metayogi\\Decorator\\ConfirmDecorator',
    ),
  ),
  'TitleDecorator' => array (
    'label' => 'Roles',
  ),
  'TableDisplay' => array (
    'fields' => array (
      'my:role' => array (
        'gadget' => '\\Metayogi\\Field\\StringField',
        'label' => 'Role',
      ),
     'ops' => array (
        'gadget' => '\\Metayogi\\Field\\OperationsField',
        'label' => 'Operations',
      ),
    ),
  ),
  'sorts' => array (
    'label' => 1,
  ),
  'rdf:type' => 'my:views',
);

$views[] = array (
  '_id' => '5061348b0de404a720000054',
  'display' => '\\Metayogi\\Display\\RecordDisplay',
  'decorators' => array('pre' => array('\\Metayogi\\Decorator\\TitleDecorator')),
  'TitleDecorator' => array (
    'label' => 'Role Display',
  ),
  'RecordDisplay' => array (
    'fields' => array (
      'my:role' => array (
        'label' => 'Role',
        'gadget' => '\\Metayogi\\Field\\StringField',
      ),
    ),
  ),
  'rdf:type' => 'my:views',
);

$views[] = array (
  '_id' => '506135000de404a320000056',
  'display' => '\\Metayogi\\Display\\FormDisplay',
  'decorators' => array (
    'pre' => array (
      0 => '\\Metayogi\\Decorator\\TitleDecorator',
    ),
  ),
  'TitleDecorator' => array (
    'label' => 'Role Form',
  ),
  'FormDisplay' => array (
    'elements' => array (
      'my:role' => array (
        'label' => 'Role',
        'widget' => '\\Metayogi\\Form\\Element\\InputElement',
        'required' => 1,
        'repeatable' => 0,
      ),
      'rdf:type' => array (
        'immutable' => 1,
        'label' => 'Record type',
        'widget' => '\\Metayogi\\Form\\Element\\RdfTypeElement',
      ),
      '_id' => array (
        'label' => 'UUID Identifier',
        'comment' => '',
        'required' => '1',
        'widget' => '\\Metayogi\\Form\\Element\\UuidElement',
      ),
    ),
  ),
  'rdf:type' => 'my:views',
);

/*
* RBACs
*/

$views[] = array (
  '_id' => '4f1f0b516c10ba9247000000',
  'display' => '\\Metayogi\\Display\\TableDisplay',
  'decorators' => array(
    'pre' => array('\\Metayogi\\Decorator\\TitleDecorator', '\\Metayogi\\Decorator\\CreateDecorator'),
    'post' => array('\\Metayogi\\Decorator\\PagerDecorator', '\\Metayogi\\Decorator\\ConfirmDecorator')
  ),
  'TitleDecorator' => array (
    'label' => 'Permissions List',
  ),
  'TableDisplay' => array (
    'fields' => array(
      'controller' => array(
        'gadget' => '\\Metayogi\\Field\\StringField',
        'label' => 'Model',
      ),
      'role' => array(
        'gadget' => '\\Metayogi\\Field\\StringField',
        'label' => 'Role',
      ),
      'actions' => array(
        'gadget' => '\\Metayogi\\Field\\StringField',
        'label' => 'Actions',
      ),
     'ops' => array (
        'gadget' => '\\Metayogi\\Field\\OperationsField',
        'label' => 'Operations',
      ),
    ),
  ),
  'sorts' => array('label' => 1),
  'rdf:type' => 'my:views',
);

$views[] = array (
  '_id' => '4fe8e683f311fe6766000002',
  'display' => '\\Metayogi\\Display\\FormDisplay',
  'decorators' => array('pre' => array('\\Metayogi\\Decorator\\TitleDecorator')),
  'TitleDecorator' => array (
    'label' => 'Permissions Form',
  ),
  'FormDisplay' => array (
    'layout' => 'form-horizontal',
    'elements' => array (
      'controller' => array (
        'label' => 'Model',
        'widget' => '\\Metayogi\\Form\\Element\\CollectionElement',
        'required' => 1,
        'repeatable' => 0,
        'collection' => array (
          'name' => 'my:controllers',
          'keys' => 'collection',
          'values' => 'label',
        ),
      ),
      'role' => array (
        'label' => 'Roles',
        'widget' => '\\Metayogi\\Form\\Element\\CollectionElement',
        'required' => 1,
        'repeatable' => 1,
        'collection' => array (
          'name' => 'my:roles',
          'keys' => 'my:role',
          'values' => 'my:role',
        ),
      ),
      'actions' => array (
        'label' => 'Action',
        'widget' => '\\Metayogi\\Form\\Element\\SelectActionElement',
        'required' => 1,
        'repeatable' => 1,
      ),
      'rdf:type' => array (
        'immutable' => 1,
        'label' => 'Record type',
        'widget' => '\\Metayogi\\Form\\Element\\RdfTypeElement',
      ),
      '_id' => array (
        'label' => 'UUID Identifier',
        'comment' => '',
        'required' => '1',
        'widget' => '\\Metayogi\\Form\\Element\\UuidElement',
      ),

    ),
  ),
  'rdf:type' => 'my:views',
);

$views[] = array (
  '_id' => '50612ae1f311fe6705000000',
  'display' => '\\Metayogi\\Display\\RecordDisplay',
  'decorators' => array('pre' => array('\\Metayogi\\Decorator\\TitleDecorator')),
  'TitleDecorator' => array (
    'label' => 'Permissions Display',
  ),
  'RecordDisplay' => array (
    'fields' =>  array (
      'controller' => array (
        'label' => 'Model',
        'gadget' => '\\Metayogi\\Field\\StringField',
      ),
      'role' => array(
        'gadget' => '\\Metayogi\\Field\\StringField',
        'label' => 'Role',
      ),
      'actions' => array(
        'gadget' => '\\Metayogi\\Field\\StringField',
        'label' => 'Actions',
      ),
    ),
  ),
  'rdf:type' => 'my:views',
);
