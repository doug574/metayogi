<?php

$views = array();

$views[] = array (
  '_id' => '4ffafcbbf311fe273a000000',
  'display' => '\\Metayogi\\Display\\TableDisplay',
  'decorators' => array(
    'pre' => array('\\Metayogi\\Decorator\\TitleDecorator', '\\Metayogi\\Decorator\\EmptyDecorator', '\\Metayogi\\Components\\Optional\\Trash\\TrashDecorator'), 
    'post' => array('\\Metayogi\\Decorator\\PagerDecorator', '\\Metayogi\\Decorator\\ConfirmDecorator')
  ),
  'TitleDecorator' => array (
    'label' => 'Trash',
  ),
  'EmptyDecorator' => array (
    'empty' => 'Trash is empty',
  ),
  'TableDisplay' => array (
    'fields' => array (
      'label' => array (
        'gadget' => '\\Metayogi\\Field\\StringField',
        'label' => 'Label/Name/Title',
      ),
      'collection' => array (
        'gadget' => '\\Metayogi\\Field\\StringField',
        'label' => 'Collection',
      ),
      'deletedate' => array (
        'gadget' => '\\Metayogi\\Field\\DatetimeField',
        'label' => 'Deleted',
      ),
     'ops' => array (
        'gadget' => '\\Metayogi\\Field\\OperationsField',
        'label' => 'Operations',
      ),
	),
  ),
  'sorts' => array (
    'deletedate' => -1,
  ),
  'pagesize' => '20',
  'empty' => 'The trash is empty.',
  'rdf:type' => 'my:views',
);
