<?php

$views = array();

$views[] = array (
  '_id' => '4ef10f946c10ba8b7c000000',
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
    'label' => 'Users',
  ),
  'TableDisplay' => array (
    'fields' => array (
      'username' => array (
        'gadget' => '\\Metayogi\\Field\\StringField',
        'label' => 'Username',
      ),
      'lastname' => array (
        'gadget' => '\\Metayogi\\Field\\StringField',
        'label' => 'Last Name',
      ),
      'firstname' => array (
        'gadget' => '\\Metayogi\\Field\\StringField',
        'label' => 'First Name',
      ),
     'ops' => array (
        'gadget' => '\\Metayogi\\Field\\OperationsField',
        'label' => 'Operations',
      ),
    ),
  ),
  'sorts' => array (
    'username' => 1,
  ),
  'rdf:type' => 'my:views',
);

$views[] = array (
  '_id' => '4fe8d954f311fe6566000002',
  'display' => '\\Metayogi\\Display\\FormDisplay',
  'decorators' => array (
    'pre' => array (
      0 => '\\Metayogi\\Decorator\\TitleDecorator',
    ),
  ),
  'TitleDecorator' => array (
    'label' => 'User Form',
  ),
  'FormDisplay' => array (
    'layout' => 'form-horizontal',
    'elements' => array (
      'username' => array (
        'label' => 'Username',
        'widget' => '\\Metayogi\\Form\\Element\\InputElement',
        'required' => 1,
        'repeatable' => 0,
      ),
      'password' => array (
        'label' => 'Password',
        'widget' => '\\Metayogi\\Form\\Element\\InputElement',
        'required' => 1,
        'repeatable' => 0,
      ),
      'firstname' => array (
        'label' => 'First Name',
        'widget' => '\\Metayogi\\Form\\Element\\InputElement',
        'required' => 1,
        'repeatable' => 0,
      ),
      'lastname' => array (
        'label' => 'Last Name',
        'widget' => '\\Metayogi\\Form\\Element\\InputElement',
        'required' => 1,
        'repeatable' => 0,
      ),
      'email' => array (
        'label' => 'Email Address',
        'widget' => '\\Metayogi\\Form\\Element\\InputElement',
        'required' => 1,
        'repeatable' => 0,
      ),
      'role' => array (
        'label' => 'Role',
        'widget' => '\\Metayogi\\Form\\Element\\CollectionElement',
        'required' => '1',
        'collection' => array (
          'name' => 'my:roles',
          'keys' => '_id',
          'values' => 'my:role',
        ),
      )
    ),
  ),
  'rdf:type' => 'my:views',
);

