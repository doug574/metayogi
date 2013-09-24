<?php

$views = array();


/* Views used for properties */

$views[] = array (
  '_id' => '5047d0c0f311fefe6e000001',
  'display' => '\\Metayogi\\Display\\TableDisplay',
  'decorators' => array(
    'pre' => array('\\Metayogi\\Decorator\\TitleDecorator', '\\Metayogi\\Decorator\\FilterDecorator', '\\Metayogi\\Decorator\\CreateDecorator'), 
    'post' => array('\\Metayogi\\Decorator\\PagerDecorator', '\\Metayogi\\Decorator\\ConfirmDecorator')
  ),
  'TitleDecorator' => array (
    'label' => 'Properties',
  ),
  'FilterDecorator' => array (
    'elements' => array (
      'domain' => array (
        'label' => 'Namespace',
        'widget' => '\\Metayogi\\Form\\Element\\CollectionElement',
        'collection' => array (
          'name' => 'my:namespaces',
          'keys' => 'prefix',
          'values' => 'title',
		),
      ),
    ),
  ),
  'TableDisplay' => array (
    'fields' => array (
      'label' => array (
        'gadget' => '\\Metayogi\\Field\\StringField',
        'label' => 'Property',
      ),
      'domain' => array (
        'gadget' => '\\Metayogi\\Field\\StringField',
        'label' => 'Namespace',
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
  '_id' => '5047d16bf311fefb6e000007',
  'display' => '\\Metayogi\\Display\\FormDisplay',
  'decorators' => array('pre' => array('\\Metayogi\\Decorator\\TitleDecorator')),
  'TitleDecorator' => array (
    'label' => 'Create/Edit Property',
  ),
  'FormDisplay' => array (
    'layout' => 'form-horizontal',
    'elements' => array (
      'name' => array (
        'label' => 'Identifier',
        'widget' => '\\Metayogi\\Form\\Element\\InputElement',
        'comment' => 'Must be unique within a namespace',
        'required' => 1,
        'repeatable' => 0,
        'immutable' => 1,
      ),
      'label' => array (
        'label' => 'Label',
        'widget' => '\\Metayogi\\Form\\Element\\InputElement',
        'required' => 1,
        'repeatable' => 0,
      ),
      'domain' => array (
        'label' => 'Namespace',
        'widget' => '\\Metayogi\\Form\\Element\\CollectionElement',
        'required' => 1,
        'collection' => array (
          'name' => 'my:namespaces',
          'keys' => 'prefix',
          'values' => 'title',
        ),
        'immutable' => 1,
      ),
      'comment' => array (
        'label' => 'Definition',
        'widget' => '\\Metayogi\\Form\\Element\\TextAreaElement',
        'required' => 0,
        'repeatable' => 0,
      ),
      'propertyType' => array (
        'widget' => '\\Metayogi\\Form\\Element\\RadioElement',
        'label' => 'Property type',
        'required' => '1',
        'options' => array (
          0 => 'Literal',
          1 => 'Object',
        ),
        'conditional' => array (
          'chain' => 'input[name=propertyType]',
          'depends' => 'input:radio[name=propertyType]:checked',
          'on' => 'Literal',
          'off' => 'Object',
          'show' => 'range',
          'hide' => 'collection',
        ),
      ),
      'range' => array (
        'label' => 'Datatype',
        'widget' => '\\Metayogi\\Form\\Element\\EnumerationElement',
        'enumerationID' => '505cebdef311fecc1b000002',
		'id' => 'range',
      ),
      'collection' => array (
        'label' => 'Class',
        'widget' => '\\Metayogi\\Form\\Element\\CollectionElement',
        'collection' => array (
          'name' => 'rdfs:classes',
          'keys' => 'qname',
          'values' => 'label',
		  'filters' => array (
		    'abstract' => 0,
		  ),
        ),
		'id' => 'collection',
      ),
      'required' => array (
        'label' => 'Required',
        'widget' => '\\Metayogi\\Form\\Element\\CheckBoxElement',
      ),
      'repeatable' => array (
        'label' => 'Repeatable',
        'widget' => '\\Metayogi\\Form\\Element\\CheckBoxElement',
      ),
      'unique' => array (
        'label' => 'Unique',
        'widget' => '\\Metayogi\\Form\\Element\\CheckBoxElement',

      ),
      'immutable' => array (
        'label' => 'Immutable',
        'widget' => '\\Metayogi\\Form\\Element\\CheckBoxElement',
      ),
	  
/*
      'enumeration' => array (
        'label' => 'Enumeration',
        'widget' => '\\Metayogi\\Form\\Element\\CollectionElement',
        'collection' => array (
          'name' => 'my:enumerations',
          'keys' => '_id',
          'values' => 'label',
        ),
        'conditional' => array(
            'depends' => 'range',
            'show' => 'xsd:string',
        ),
      ),


      'length' => array (
        'label' => 'Length',
        'widget' => '\\Metayogi\\Form\\Element\\InputElement',
        'conditional' => array(
            'depends' => 'range',
            'show' => '*',
        ),
      ),

      'pattern' => array (
        'label' => 'Pattern',
        'widget' => '\\Metayogi\\Form\\Element\\InputElement',
        'conditional' => array(
            'depends' => 'range',
            'show' => 'xsd:string',
        ),
      ),
      'minLength' => array (
        'label' => 'Min length',
        'widget' => '\\Metayogi\\Form\\Element\\InputElement',
        'conditional' => array(
            'depends' => 'range',
            'show' => 'xsd:string',
        ),
      ),
      'maxLength' => array (
        'label' => 'Max length',
        'widget' => '\\Metayogi\\Form\\Element\\InputElement',
        'conditional' => array(
            'depends' => 'range',
            'show' => 'xsd:string',
        ),
      ),
      'minInclusive' => array (
        'label' => 'Min value',
        'widget' => '\\Metayogi\\Form\\Element\\InputElement',
        'conditional' => array(
            'depends' => 'range',
            'show' => 'xsd:decimal',
        ),
      ),
      'maxInclusive' => array (
        'label' => 'Max value',
        'widget' => '\\Metayogi\\Form\\Element\\InputElement',
        'conditional' => array(
            'depends' => 'range',
            'show' => 'xsd:decimal',
        ),
      ),
*/
      'gadget' => array (
        'label' => 'Gadget',
        'widget' => '\\Metayogi\Components\Core\ModelWizard\\SelectGadgetElement',
        'required' => 1,
      ),
      'widget' => array (
        'label' => 'Widget',
        'widget' => '\\Metayogi\Components\Core\ModelWizard\\SelectWidgetElement',
        'required' => 1,
      ),
      '_id' => array (
        'label' => 'UUID Identifier',
        'comment' => '',
        'required' => '1',
        'widget' => '\\Metayogi\\Form\\Element\\UuidElement',
      ),
      'rdf:type' => array (
        'collection' => 'rdfs:classes',
        'comment' => '',
        'immutable' => 0,
        'label' => 'Record type',
        'required' => 1,
        'widget' => '\\Metayogi\\Form\\Element\\RdfTypeElement',
      ),
    ),
  ),
  'rdf:type' => 'my:views',
);

$views[] = array (
  '_id' => '50525e84f311feff7b000003',
  'display' => '\\Metayogi\\Components\\Core\\ModelWizard\\PropertyDisplay',
  'decorators' => array('pre' => array('\\Metayogi\\Decorator\\TitleDecorator')),
  'TitleDecorator' => array (
    'label' => 'Property Display',
  ),
  'PropertyDisplay' => array (
    'fields' =>  array (
      'name' => array (
        'gadget' => '\\Metayogi\\Field\\StringField',
        'label' => 'Name',
      ),
      'label' => array (
        'gadget' => '\\Metayogi\\Field\\StringField',
        'label' => 'Label',
      ),
      'domain' => array (
        'label' => 'Namespace',
        'gadget' => '\\Metayogi\\Field\\StringField',
      ),
      'comment' => array (
        'label' => 'Description',
        'gadget' => '\\Metayogi\\Field\\TextField',
      ),
      'range' => array (
        'label' => 'Type',
        'gadget' => '\\Metayogi\\Field\\StringField',
      ),
	),
  ),
  'rdf:type' => 'my:views',
);


/* Views used for classes */

$views[] = array (
  '_id' => '504917c2f311fefb6e00000a',
  'display' => '\\Metayogi\\Display\\TableDisplay',
  'decorators' => array(
    'pre' => array('\\Metayogi\\Decorator\\TitleDecorator', '\\Metayogi\\Decorator\\FilterDecorator', '\\Metayogi\\Decorator\\CreateDecorator'), 
    'post' => array('\\Metayogi\\Decorator\\PagerDecorator', '\\Metayogi\\Decorator\\ConfirmDecorator')
  ),
  'TitleDecorator' => array (
    'label' => 'Classes',
  ),
  'FilterDecorator' => array (
    'elements' => array (
      'domain' => array (
        'label' => 'Namespace',
        'widget' => '\\Metayogi\\Form\\Element\\CollectionElement',
        'collection' => array (
          'name' => 'my:namespaces',
          'keys' => 'prefix',
          'values' => 'title',
		),
      ),
    ),
  ),
  'TableDisplay' => array (
    'fields' => array (
      'label' => array (
        'gadget' => '\\Metayogi\\Field\\StringField',
        'label' => 'Class',
      ),
      'domain' => array (
        'gadget' => '\\Metayogi\\Field\\StringField',
        'label' => 'Namespace',
      ),
      'ops' => array (
        'gadget' => '\\Metayogi\\Field\\OperationsField',
        'label' => 'Operations',
      ),
    ),
  ),
  'sorts' => array (
    'name' => 1,
  ),
  'rdf:type' => 'my:views',
);


$views[] = array (
  '_id' => '50491882f311feff6e000004',
  'display' => '\\Metayogi\\Display\\FormDisplay',
  'decorators' => array('pre' => array('\\Metayogi\\Decorator\\TitleDecorator')),
  'TitleDecorator' => array (
    'label' => 'Create/Edit Class',
  ),
  'FormDisplay' => array (
    'layout' => 'form-horizontal',
    'elements' => array (
      'name' => array (
        'label' => 'ID',
        'widget' => '\\Metayogi\\Form\\Element\\InputElement',
        'required' => 1,
        'repeatable' => 0,
        'immutable' => 1,
      ),
      'label' => array (
        'label' => 'Label',
        'widget' => '\\Metayogi\\Form\\Element\\InputElement',
        'required' => 1,
        'repeatable' => 0,
      ),
      'comment' => array (
        'label' => 'Definition',
        'widget' => '\\Metayogi\\Form\\Element\\TextAreaElement',
        'required' => 0,
        'repeatable' => 0,
      ),
      'domain' => array (
        'label' => 'Belongs To',
        'widget' => '\\Metayogi\\Form\\Element\\CollectionElement',
        'required' => 1,
        'collection' => array (
          'name' => 'my:namespaces',
          'keys' => 'prefix',
          'values' => 'title',
        ),
        'immutable' => 1,
      ),
      'abstract' => array (
        'label' => 'Abstract class',
        'widget' => '\\Metayogi\\Form\\Element\\CheckBoxElement',
		'comment' => 'Used as a superclass for other classes and will not have instances of its own',
      ),
      'subclass' => array (
        'label' => 'Subclass of',
        'widget' => '\\Metayogi\\Components\\Core\\Relation\\RelationElement',
        'size' => 5,
        'repeatable' => 1,
        'collection' => array (
          'name' => 'rdfs:classes',
          'keys' => '_id',
          'values' => 'qname',
        ),
        'default' => array (
          0 => '50c0f9f7f311fed270000056',
          1 => '51a79a04f311fe4038000003',
        ),
        'help' => 'You may click and drag items to order.',
      ),
      'properties' => array (
        'label' => 'Properties',
        'widget' => '\\Metayogi\\Components\\Core\\Relation\\RelationElement',
        'required' => 0,
        'repeatable' => 1,
        'size' => 5,
        'collection' => array (
          'name' => 'rdf:properties',
          'keys' => '_id',
          'values' => 'qname',
        ),
        'help' => 'You may click and drag items to order.',
      ),
      /*
      'components' => array (
        'label' => 'Components',
        'widget' => '\\Metayogi\\Form\\Element\\CollectionElement',
        'size' => 5,
        'repeatable' => 1,
        'collection' => array (
          'name' => 'my:components',
          'keys' => '_id',
          'values' => 'name',
          'filters' => array (
            'enabled' => '1',
            'classAddon' => '1',
          ),
        ),
        'help' => 'You may click and drag items to order.',
      ),
      */
      '_id' => array (
        'label' => 'UUID Identifier',
        'comment' => '',
        'required' => '1',
        'widget' => '\\Metayogi\\Form\\Element\\UuidElement',
      ),
      'rdf:type' => array (
        'collection' => 'rdfs:classes',
        'comment' => '',
        'immutable' => 0,
        'label' => 'Record type',
        'required' => 1,
        'widget' => '\\Metayogi\\Form\\Element\\RdfTypeElement',
      ),
    ),
  ),
  'rdf:type' => 'my:views',
);

$views[] = array (
  '_id' => '5052600af311fefe7b000000',
  'display' => '\\Metayogi\\Components\\Core\\ModelWizard\\ClassDisplay',
  'decorators' => array('pre' => array('\\Metayogi\\Decorator\\TitleDecorator', '\\Metayogi\\Components\\Core\\ModelWizard\\ClassBreadcrumbDecorator')),
  'TitleDecorator' => array (
    'label' => 'Class Display',
    'hidden' => '1',
  ),
  'ClassBreadcrumbDecorator' => array (
    'parent' => 'subclass',
  ),
  'ClassDisplay' => array (
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


/* Views used for namespaces */


$views[] = array (
  '_id' => '5047c965f311fefd6e000001',
  'display' => '\\Metayogi\\Display\\TableDisplay',
  'decorators' => array(
    'pre' => array('\\Metayogi\\Decorator\\TitleDecorator', '\\Metayogi\\Decorator\\CreateDecorator'), 
    'post' => array('\\Metayogi\\Decorator\\PagerDecorator', '\\Metayogi\\Decorator\\ConfirmDecorator')
  ),
  'TitleDecorator' => array (
    'label' => 'Namespaces',
  ),
  'TableDisplay' => array (
    'fields' => array (
      'prefix' => array (
        'gadget' => '\\Metayogi\\Field\\StringField',
        'label' => 'Prefix',
      ),
      'title' => array (
        'gadget' => '\\Metayogi\\Field\\StringField',
        'label' => 'Title',
      ),
      'ops' => array (
        'gadget' => '\\Metayogi\\Field\\OperationsField',
        'label' => 'Operations',
      ),
	),
  ),
  'sorts' => array (
    'prefix' => 1,
  ),
  'rdf:type' => 'my:views',
);

$views[] = array (
  '_id' => '5047ca81f311fefd6e000002',
  'display' => '\\Metayogi\\Display\\FormDisplay',
  'decorators' => array('pre' => array('\\Metayogi\\Decorator\\TitleDecorator')),
  'TitleDecorator' => array (
    'label' => 'Create/Edit Namespace',
  ),
  'FormDisplay' => array (
    'layout' => 'form-horizontal',
    'elements' => array (
      'title' => array (
        'label' => 'Label',
        'widget' => '\\Metayogi\\Form\\Element\\InputElement',
        'required' => 1,
        'repeatable' => 0,
      ),
      'prefix' => array (
        'label' => 'Prefix',
        'widget' => '\\Metayogi\\Form\\Element\\InputElement',
        'required' => 1,
        'repeatable' => 0,
        'immutable' => 1,
      ),
      'url' => array (
        'label' => 'URL',
        'widget' => '\\Metayogi\\Form\\Element\\InputElement',
        'required' => 1,
        'repeatable' => 0,
      ),
      '_id' => array (
        'label' => 'UUID Identifier',
        'comment' => '',
        'required' => '1',
        'widget' => '\\Metayogi\\Form\\Element\\UuidElement',
      ),
      'rdf:type' => array (
        'collection' => 'rdfs:classes',
        'comment' => '',
        'immutable' => 0,
        'label' => 'Record type',
        'required' => 1,
        'widget' => '\\Metayogi\\Form\\Element\\RdfTypeElement',
      ),
    ),
  ),
  'rdf:type' => 'my:views',
);

$views[] = array (
  '_id' => '50526323f311fee97b000003',
  'display' => '\\Metayogi\\Display\\RecordDisplay',
  'decorators' => array('pre' => array('\\Metayogi\\Decorator\\TitleDecorator')),
  'TitleDecorator' => array (
    'label' => 'Namespace Display',
  ),
  'RecordDisplay' => array (
    'fields' => array (
      'title' => array (
        'gadget' => '\\Metayogi\\Field\\StringField',
        'label' => 'Title',
      ),
      'prefix' => array (
        'gadget' => '\\Metayogi\\Field\\StringField',
        'label' => 'Prefix',
	  ),
    ),
  ),
  'rdf:type' => 'my:views',
);



/* Enumerations */

$views[] = array (
  '_id' => '4ed537c96c10ba0030070000',
  'display' => '\\Metayogi\\Display\\TableDisplay',
  'decorators' => array(
    'pre' => array('\\Metayogi\\Decorator\\TitleDecorator', '\\Metayogi\\Decorator\\FilterDecorator', '\\Metayogi\\Decorator\\CreateDecorator'), 
    'post' => array('\\Metayogi\\Decorator\\PagerDecorator', '\\Metayogi\\Decorator\\ConfirmDecorator')
  ),
  'TitleDecorator' => array (
    'label' => 'Enumerations',
  ),
  'TableDisplay' => array (
    'fields' => array (
      'label' => array (
        'gadget' => '\\Metayogi\\Field\\StringField',
        'label' => 'Name',
      ),
      'domain' => array (
        'gadget' => '\\Metayogi\\Field\\StringField',
        'label' => 'Namespace',
      ),
      'ops' => array (
        'gadget' => '\\Metayogi\\Field\\OperationsField',
        'label' => 'Operations',
      ),
	),
  ),
  'sorts' => array (
    'name' => 1,
  ),
  'rdf:type' => 'my:views',
);

$views[] = array (
  '_id' => '5069def90de404f00d000001',
  'display' => '\\Metayogi\\Display\\FormDisplay',
  'decorators' => array('pre' => array('\\Metayogi\\Decorator\\TitleDecorator')),
  'TitleDecorator' => array (
    'label' => 'Create/Edit Enumeration',
  ),
  'FormDisplay' => array (
    'elements' => array (
      'label' => array (
        'label' => 'Label',
        'widget' => '\\Metayogi\\Form\\Element\\InputElement',
        'required' => 1,
      ),
      'domain' => array (
        'label' => 'Belongs To',
        'widget' => '\\Metayogi\\Form\\Element\\CollectionElement',
        'required' => 1,
        'collection' => array (
          'name' => 'my:namespaces',
          'keys' => 'prefix',
          'values' => 'title',
        ),
        'immutable' => 1,
      ),
      'list' => array (
        'label' => 'List',
        'widget' => '\\Metayogi\\Form\\Element\\EnumArea',
        'required' => 0,
      ),
    ),
  ),
  'rdf:type' => 'my:views',
);


