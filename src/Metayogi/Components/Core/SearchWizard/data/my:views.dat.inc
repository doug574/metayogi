<?php

$views = array();

$views[] = array (
  '_id' => '505030adf311feff7b000000',
  'display' => '\\Metayogi\\Display\\FormDisplay',
  'decorators' => array('pre' => array('\\Metayogi\\Decorator\\TitleDecorator')),
  'TitleDecorator' => array(
    'label' => 'Create/Edit Search Index',
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
      'type' => array (
        'label' => 'Index Type',
        'widget' => '\\Metayogi\\Form\\Element\\EnumerationElement',
        'enumerationID' => '506c8fcf0de404f30d000033',
      ),
      'properties' => array (
        'label' => 'Properties',
        'widget' => '\\Metayogi\\Components\\Core\\Relation\\RelationElement',
        'required' => 1,
        'repeatable' => 1,
        'collection' => array (
          'name' => 'rdf:properties',
          'keys' => '_id',
          'values' => 'qname',
        ),
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
  'controllerID' => '50502f1ef311fee77b000000',
  'rdf:type' => 'my:views',
);

$views[] = array (
  '_id' => '50502fa4f311fee57b000000',
  'display' => '\\Metayogi\\Display\\TableDisplay',
  'decorators' => array(
    'pre' => array('\\Metayogi\\Decorator\\TitleDecorator', '\\Metayogi\\Decorator\\CreateDecorator'), 
    'post' => array('\\Metayogi\\Decorator\\PagerDecorator', '\\Metayogi\\Decorator\\ConfirmDecorator')
  ),
  'TitleDecorator' => array(
    'label' => 'Search Indexes',
  ),
  'TableDisplay' => array (
    'fields' => array (
      'label' => array (
        'gadget' => '\\Metayogi\\Field\\StringField',
        'label' => 'Index',
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
  'pagesize' => '20',
  'controllerID' => '50502f1ef311fee77b000000',
  'rdf:type' => 'my:views',
);

/* Search Form Views */

$views[] = array (
  '_id' => '506d99cb0de404f30d000056',
  'display' => '\\Metayogi\\Display\\TableDisplay',
  'decorators' => array(
    'pre' => array('\\Metayogi\\Decorator\\TitleDecorator', '\\Metayogi\\Decorator\\CreateDecorator'), 
    'post' => array('\\Metayogi\\Decorator\\PagerDecorator', '\\Metayogi\\Decorator\\ConfirmDecorator')
  ),
  'TitleDecorator' => array(
    'label' => 'Search Forms',
  ),
  'TableDisplay' => array (
    'fields' => array (
      'label' => array (
        'gadget' => '\\Metayogi\\Field\\StringField',
        'label' => 'Name',
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
  'pagesize' => 20,
  'controllerID' => '506d99cb0de404f30d000055',
  'rdf:type' => 'my:views',
);

$views[] = array (
  '_id' => '506d99cb0de404f30d000057',
  'display' => '\\Metayogi\\Display\\RecordDisplay',
  'decorators' => array('pre' => array('\\Metayogi\\Decorator\\TitleDecorator')),
  'TitleDecorator' => array (
    'label' => 'Search Forms Display',
  ),
  'RecordDisplay' => array (
    'fields' => array (
      'name' => array (
        'label' => 'Identifier',
        'gadget' => '\\Metayogi\\Field\\StringField',
      ),
      'label' => array (
        'label' => 'Label',
        'gadget' => '\\Metayogi\\Field\\StringField',
	  ),
    ),
  ),
  'controllerID' => '506d99cb0de404f30d000055',
  'rdf:type' => 'my:views',
);

$views[] = array (
  '_id' => '506d99cb0de404f30d000058',
  'display' => '\\Metayogi\\Display\\FormDisplay',
  'decorators' => array('pre' => array('\\Metayogi\\Decorator\\TitleDecorator')),
  'TitleDecorator' => array (
    'label' => 'Create/Edit Search Form',
  ),
  'FormDisplay' => array (
    'layout' => 'form-horizontal',
    'elements' => array (
      'name' => array (
        'label' => 'Identifier',
        'widget' => '\\Metayogi\\Form\\Element\\InputElement',
		'immutable' => '1',
      ),
      'label' => array (
        'label' => 'Label',
        'widget' => '\\Metayogi\\Form\\Element\\InputElement',
      ),
      'layout' => array (
        'label' => 'Layout',
        'widget' => '\\Metayogi\\Form\\Element\\CollectionElement',
        'repeatable' => 0,
        'collection' => array (
          'name' => 'my:layouts',
          'keys' => '_id',
          'values' => 'label',
        ),
      ),
/*
      'types' => array (
        'label' => 'Record type (classes)',
        'widget' => '\\Metayogi\\Form\\Element\\CollectionElement',
        'repeatable' => 1,
        'collection' => array (
          'name' => 'rdfs:classes',
          'keys' => '_id',
          'values' => 'label',
          'filters' => array (
            'components' => '513057f0f311fe6416000006',
          ),
        ),
      ),
*/
      'facets' => array (
        'label' => 'Facets',
        'widget' => '\\Metayogi\\Form\\Element\\CollectionElement',
        'repeatable' => 1,
        'collection' => array (
          'name' => 'my:indexes',
          'keys' => '_id',
          'values' => 'label',
          'filters' => array (
            'type' => '_s',
          ),
        ),
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
	  'basic' => array (
	    'legend' => 'Basic form',
		'widget' => '\\Metayogi\\Form\\Container\\FieldsetContainer',
		'elements' => array (
      'basic_fields' => array (
        'widget' => '\\Metayogi\\Form\\Element\\HiddenElement',
		'value' => '1',
      ),

      'basic_indexes' => array (
        'label' => 'Indexes',
        'widget' => '\\Metayogi\\Form\\Element\\CollectionElement',
        'repeatable' => 1,
        'collection' => array (
          'name' => 'my:indexes',
          'keys' => '_id',
          'values' => 'label',
          'filters' => array (
            'type' => '_t',
          ),
        ),
      ),
      'basic_limits' => array (
        'label' => 'Restrictors',
        'widget' => '\\Metayogi\\Form\\Element\\CollectionElement',
        'repeatable' => 1,
        'collection' => array (
          'name' => 'my:indexes',
          'keys' => '_id',
          'values' => 'label',
          'filters' => array (
            '$or' => array (
              0 => array (
                'type' => '_b',
              ),
              1 => array (
                'type' => '_s',
              ),
            ),
          ),
        ),
      ), ), ),
	  'advanced' => array (
	    'legend' => 'Advanced form',
		'widget' => '\\Metayogi\\Form\\Container\\FieldsetContainer',
	    'elements' => array (
      'advanced_fields' => array (
        'label' => 'Search fields',
        'widget' => '\\Metayogi\\Form\\Element\\InputElement',
        'default' => 3,
      ),
      'advanced_indexes' => array (
        'label' => 'Indexes',
        'widget' => '\\Metayogi\\Form\\Element\\CollectionElement',
        'repeatable' => 1,
        'collection' => array (
          'name' => 'my:indexes',
          'keys' => '_id',
          'values' => 'label',
          'filters' => array (
            'type' => '_t',
          ),
        ),
      ),
      'advanced_limits' => array (
        'label' => 'Restrictors',
        'widget' => '\\Metayogi\\Form\\Element\\CollectionElement',
        'repeatable' => 1,
        'collection' => array (
          'name' => 'my:indexes',
          'keys' => '_id',
          'values' => 'label',
          'filters' => array (
            '$or' => array (
              0 => array (
                'type' => '_b',
              ),
              1 => array (
                'type' => '_s',
              ),
            ),
          ),
        ),
      ), ), ),

/*
      'alias' => array (
        'label' => 'Route alias',
        'widget' => '\\Metayogi\\Form\\Element\\InputElement',
        'required' => 1,
      ),
*/
    ),
  ),
  'controllerID' => '506d99cb0de404f30d000055',
  'rdf:type' => 'my:views',
);

