<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

$views = array();

$views[] = array (
  '_id' => '504a6ef6f311fe016f000004',
  'display' => '\\Metayogi\\Components\\Core\\Controller\\ControllerDisplay',
  'decorators' => array(
    'pre' => array('\\Metayogi\\Decorator\\TitleDecorator'), 
    'post' => array('\\Metayogi\\Decorator\\PagerDecorator', '\\Metayogi\\Decorator\\ConfirmDecorator')
  ),
  'TitleDecorator' => array (
    'label' => 'Class Behaviours',
  ),
  'ControllerDisplay' => array (
  ),
  'sorts' => array (
    'name' => 1,
  ),
  'rdf:type' => 'my:views',
);

$views[] = array (
  '_id' => '504a70daf311fe006f000003',
  'display' => '\\Metayogi\\Display\\FormDisplay',
  'decorators' => array('pre' => array('\\Metayogi\\Decorator\\TitleDecorator')),
  'TitleDecorator' => array (
    'label' => 'Controllers Form',
  ),
  'FormDisplay' => array (
    'layout' => 'form-horizontal',
    'elements' => array (
      'name' => array (
        'label' => 'ID',
        'widget' => '\\Metayogi\\Form\\Element\\InputElement',
        'required' => 1,
        'repeatable' => 0,
      ),
      'label' => array (
        'label' => 'Label',
        'widget' => '\\Metayogi\\Form\\Element\\InputElement',
        'required' => 1,
        'repeatable' => 0,
      ),
      'collection' => array (
        'label' => 'Collection',
        'widget' => '\\Metayogi\\Form\\Element\\InputElement',
        'required' => 0,
      ),
      'CRUDpath' => array (
        'label' => 'Admin Path',
        'widget' => '\\Metayogi\\Form\\Element\\InputElement',
        'required' => 0,
      ),
      /*
      'actions' => array (
        'label' => 'Actions',
        'widget' => 'myMultiSelectEnumeration',
        'enum' => '4edbea2b6c10baec69000000',
        'required' => 0,
        'repeatable' => 1,
        'size' => 5,
      ),
      
      'components' => array (
        'label' => 'Components',
        'widget' => '\\Metayogi\\Form\\Element\\CollectionElement',
        'size' => 5,
        'repeatable' => 1,
        'taxonomylist' => array (
          'collection' => 'my:components',
          'keys' => 'name',
          'values' => 'name',
        ),
      ),
      */
    ),
  ),
  'rdf:type' => 'my:views',
);

$views[] = array (
  '_id' => '504a735cf311fefd6e000005',
  'display' => '\\Metayogi\\Display\\RecordDisplay',
  'decorators' => array('pre' => array('\\Metayogi\\Decorator\\TitleDecorator')),
  'TitleDecorator' => array (
    'label' => 'Controller Display',
  ),
  'RecordDisplay' => array (
    'fields' => array (
      'name' => array (
        'gadget' => '\\Metayogi\\Field\\StringField',
        'label' => 'Name',
      ),
      'label' => array (
        'gadget' => '\\Metayogi\\Field\\StringField',
        'label' => 'Label',
      ),
    ),
  ),
  'rdf:type' => 'my:views',
);

