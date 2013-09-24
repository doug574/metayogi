<?php

$views = array();

/*
* Views
*/

$views[] = array (
  '_id' => '4ed5349c6c10baff2f050000',
  'display' => '\\Metayogi\\Display\\TableDisplay',
  'decorators' => array(
    'pre' => array('\\Metayogi\\Decorator\\TitleDecorator', '\\Metayogi\\Decorator\\FilterDecorator'), 
    'post' => array('\\Metayogi\\Decorator\\PagerDecorator', '\\Metayogi\\Decorator\\ConfirmDecorator')
  ),
  'TitleDecorator' => array (
    'label' => 'Views',
  ),
  'FilterDecorator' => array (
    'elements' => array (
      'modelID' => array (
        'label' => 'Model',
        'widget' => '\\Metayogi\\Form\\Element\\CollectionElement',
        'collection' => array (
          'name' => 'rdfs:classes',
          'keys' => '_id',
          'values' => 'label',
		  'filters' => array (
		    'abstract' => 0,
		  ),
		),
      ),
    ),
	'default' => array (
	  'modelID' => array ('$exists' => 1),
	),
  ),
  'TableDisplay' => array (
    'fields' => array (
      'myTitleDecorator/label' => array (
        'gadget' => '\\Metayogi\\Field\\StringField',
        'label' => 'Name',
      ),
      'display' => array (
        'gadget' => '\\Metayogi\\Field\\StringField',
        'label' => 'Type',
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
  '_id' => '4fdb74b9f311fece7e000008',
  'display' => '\\Metayogi\\Display\\FormDisplay',
  'decorators' => array('pre' => array('\\Metayogi\\Decorator\\TitleDecorator')),
  'TitleDecorator' => array(
    'label' => 'View Designer',
  ),
  'FormDisplay' => array (
    'elements' => array (
      'modelID' => array (
        'id' => 'model',
        'label' => 'Model',
        'widget' => '\\Metayogi\\Form\\Element\\CollectionElement',
        'collection' => array (
          'name' => 'rdfs:classes',
          'keys' => '_id',
          'values' => 'label',
        ),
        'required' => 1,
        'immutable' => 1,
        'conditional' => array (
          'depends' => 'view',
          'show' => '*',
        ),
      ),
      'controllerID' => array (
        'widget' => '\\Metayogi\\Form\\Element\\HiddenElement',
      ),
      'modelID' => array (
        'widget' => '\\Metayogi\\Form\\Element\\HiddenElement',
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
* Fieldsets
*/

$views[] = array (
  '_id' => '51d54002f311fe7509586a5e',
  'display' => '\\Metayogi\\Display\\TableDisplay',
  'decorators' => array (
    'pre' => array (
      0 => '\\Metayogi\\Decorator\\TitleDecorator',
	  1 => '\\Metayogi\\Decorator\\FilterDecorator',
      2 => '\\Metayogi\\Decorator\\CreateDecorator',
    ),
    'post' => array (
      0 => '\\Metayogi\\Decorator\\PagerDecorator',
      1 => '\\Metayogi\\Decorator\\ConfirmDecorator',
    ),
  ),
  'TitleDecorator' => array (
    'label' => 'Fieldset List',
  ),
  'FilterDecorator' => array (
    'elements' => array (
      'model' => array (
        'label' => 'Model',
        'widget' => '\\Metayogi\\Form\\Element\\CollectionElement',
        'collection' => array (
          'name' => 'rdfs:classes',
          'keys' => 'qname',
          'values' => 'label',
		  'filters' => array (
		    'abstract' => 0,
		  ),
		),
      ),
    ),
  ),
  'TableDisplay' => array (
    'fields' => array (
      'name' => array (
        'label' => 'Name',
        'gadget' => '\\Metayogi\\Field\\StringField',
      ),
      'model' => array (
        'label' => 'Model',
        'gadget' => '\\Metayogi\\Field\\StringField',
      ),
     'ops' => array (
        'gadget' => '\\Metayogi\\Field\\OperationsField',
        'label' => 'Operations',
      ),
    ),
  ),
  'controllerID' => '51d54002f311fe7509586a5d',
  'rdf:type' => 'my:views',
);

$views[] = array (
  '_id' => '51d54002f311fe7509586a5f',
  'display' => '\\Metayogi\\Display\\RecordDisplay',
  'decorators' => array (
    'pre' => array (
      0 => '\\Metayogi\\Decorator\\TitleDecorator',
    ),
  ),
  'TitleDecorator' => array (
    'label' => 'Fieldset Display',
  ),
  'RecordDisplay' => array (
    'fields' => array (
      'name' => array (
        'label' => 'Name',
        'gadget' => '\\Metayogi\\Field\\StringField',
      ),
      'model' => array (
        'label' => 'Model',
        'gadget' => '\\Metayogi\\Field\\StringField',
      ),
      '_id' => array (
        'label' => 'UUID Identifier',
        'gadget' => '\\Metayogi\\Field\\StringField',
      ),
      'rdf:type' => array (
        'label' => 'Record type',
        'gadget' => '\\Metayogi\\Field\\StringField',
      ),
    ),
  ),
  'controllerID' => '51d54002f311fe7509586a5d',
  'rdf:type' => 'my:views',
);

$views[] = array (
  '_id' => '51d54002f311fe7509586a60',
  'display' => '\\Metayogi\\Display\\FormDisplay',
  'decorators' => array (
    'pre' => array (
      0 => '\\Metayogi\\Decorator\\TitleDecorator',
    ),
  ),
  'TitleDecorator' => array (
    'label' => 'Fieldset Form',
  ),
  'FormDisplay' => array (
    'layout' => 'form-horizontal',
    'elements' => array (
      'name' => array (
        'label' => 'Name',
        'comment' => '',
        'collection' => '',
        'required' => 0,
        'repeatable' => 0,
        'unique' => 0,
        'immutable' => 0,
        'widget' => '\\Metayogi\\Form\\Element\\InputElement',
      ),
      'model' => array (
        'label' => 'Model',
        'comment' => '',
        'collection' => '',
        'required' => 0,
        'repeatable' => 0,
        'unique' => 0,
        'immutable' => 0,
        'widget' => '\\Metayogi\\Form\\Element\\InputElement',
      ),
      '_id' => array (
        'label' => 'UUID Identifier',
        'comment' => 'Unique identifier for this resource',
        'required' => '1',
        'widget' => '\\Metayogi\\Form\\Element\\UuidElement',
      ),
      'rdf:type' => array (
        'comment' => 'The Class this resource belongs to',
        'immutable' => 0,
        'label' => 'Record type',
        'required' => 1,
        'widget' => '\\Metayogi\\Form\\Element\\RdfTypeElement',
      ),
    ),
  ),
  'controllerID' => '51d54002f311fe7509586a5d',
  'rdf:type' => 'my:views',
);