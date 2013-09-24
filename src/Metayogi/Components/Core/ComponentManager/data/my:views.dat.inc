<?php

$views = array();

$views[] = array (
  '_id' => '5015a6f2f311fe4627000000',
  'display' => '\\Metayogi\\Display\\TableDisplay',
  'decorators' => array (
    'pre' => array (
      0 => '\\Metayogi\\Decorator\\TitleDecorator',
      1 => '\\Metayogi\\Decorator\\FilterDecorator',
    ),
  ),
  'TitleDecorator' => array (
    'label' => 'Components',
  ),
  'FilterDecorator' => array (
    'elements' => array (
      'category' => array (
        'label' => 'Category',
        'widget' => '\\Metayogi\\Form\\Element\\SelectElement',
        'optionlist' => array (
          0 => 'Core',
          1 => 'Developer',
          2 => 'Local',
          3 => 'Optional',
        ),
      ),
    ),
    'default' => array (
      'category' => 'Optional',
    ),
  ),
  'TableDisplay' => array (
    'fields' => array (
      'category' => 
      array (
        'gadget' => '\\Metayogi\\Field\\StringField',
        'label' => 'Category',
      ),
      'label' => 
      array (
        'gadget' => '\\Metayogi\\Field\\StringField',
        'label' => 'Component',
      ),
      'description' => 
      array (
        'gadget' => '\\Metayogi\\Field\\StringField',
        'label' => 'Description',
      ),
      'ops' => 
      array (
        'gadget' => '\\Metayogi\\Field\\OperationsField',
        'label' => 'Operations',
      ),
    ),
  ),
  'sorts' => array (
    'category' => 1,
    'label' => 1,
  ),
  'pagesize' => '100',
  'rdf:type' => 'my:views',
);

$views[] = array (
  '_id' => '50ef2504f311fe0169000ff2',
  'decorators' => array('pre' => array('\\Metayogi\\Decorator\\TitleDecorator')),
  'TitleDecorator' => array (
    'label' => 'Configure Component',
  ),
  'display' => '\\Metayogi\\Display\\FormDisplay',
  'rdf:type' => 'my:views',
);
