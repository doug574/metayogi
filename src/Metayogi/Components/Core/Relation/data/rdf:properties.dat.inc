<?php

$properties = array();

$properties[] = array (
  '_id' => '50c24967f311fed670000067',
  'name' => 'dateCreated',
  'label' => 'Date created',
  'domain' => 'my',
  'comment' => 'Timestamp of when this resource record was created',
  'propertyType' => 'Literal',
  'range' => 'xsd:dateTime',
  'required' => 1,
  'repeatable' => 0,
  'unique' => 0,
  'immutable' => 1,
  'qname' => 'my:dateCreated',
  'rdf:type' => 'rdf:properties',
  'gadget' => '\\Metayogi\\Field\\DatetimeField',
  'widget' => '\\Metayogi\\Form\\Element\\TimeStampElement',
);

$properties[] = array (
  '_id' => '50c24984f311fed270000086',
  'name' => 'dateModified',
  'label' => 'Date modified',
  'domain' => 'my',
  'comment' => 'Timestamp of when this resource record was last modified',
  'propertyType' => 'Literal',
  'range' => 'xsd:dateTime',
  'required' => 1,
  'repeatable' => 0,
  'unique' => 0,
  'immutable' => 0,
  'qname' => 'my:dateModified',
  'rdf:type' => 'rdf:properties',
  'gadget' => '\\Metayogi\\Field\\DatetimeField',
  'widget' => '\\Metayogi\\Form\\Element\\TimeStampElement',
);

$properties[] = array (
  '_id' => '50e48562f311fe7d5400003b',
  'comment' => 'The Class this resource belongs to',
  'domain' => 'rdf',
  'immutable' => 0,
  'label' => 'Record type',
  'name' => 'type',
  'qname' => 'rdf:type',
  'propertyType' => 'Literal',
  'range' => 'xsd:string',
  'required' => 1,
  'rdf:type' => 'rdf:properties',
  'gadget' => '\\Metayogi\\Field\\StringField',
  'widget' => '\\Metayogi\\Form\\Element\\RdfTypeElement',
);

$properties[] = array (
  '_id' => '50e4868af311fe7f5400002b',
  'comment' => 'Whether this resource record is available to the public',
  'domain' => 'my',
  'label' => 'Live',
  'name' => 'live',
  'qname' => 'my:live',
  'propertyType' => 'Literal',
  'range' => 'xsd:boolean',
  'default' => 'true',
  'rdf:type' => 'rdf:properties',
  'gadget' => '\\Metayogi\\Field\\BooleanField',
  'widget' => '\\Metayogi\\Form\\Element\\CheckBoxElement',
);

$properties[] = array (
  '_id' => '519e95d6f311fec14382932c',
  'name' => 'createdBy',
  'label' => 'Created by',
  'domain' => 'my',
  'comment' => 'UserID of the person who created this resource record',
  'propertyType' => 'Literal',
  'range' => 'xsd:string',
  'required' => 0,
  'repeatable' => 0,
  'rdf:type' => 'rdf:properties',
  'qname' => 'my:createdBy',
  'gadget' => '\\Metayogi\\Field\\StringField',
  'widget' => '\\Metayogi\\Form\\Element\\UserElement',
);

$properties[] = array (
  '_id' => '519e9660f311febc43651a58',
  'name' => 'modifiedBy',
  'label' => 'Last modified by',
  'domain' => 'my',
  'comment' => 'UserID of the person who last modified this resource record',
  'propertyType' => 'Literal',
  'range' => 'xsd:string',
  'required' => 0,
  'repeatable' => 0,
  'rdf:type' => 'rdf:properties',
  'qname' => 'my:modifiedBy',
  'gadget' => '\\Metayogi\\Field\\StringField',
  'widget' => '\\Metayogi\\Form\\Element\\UserElement',
);

$properties[] = array (
  '_id' => '51a79b71f311fe3b38000019',
  'name' => '_id',
  'label' => 'UUID Identifier',
  'domain' => 'my',
  'comment' => 'Unique identifier for this resource',
  'propertyType' => 'Literal',
  'range' => 'xsd:string',
  'required' => '1',
  'gadget' => '\\Metayogi\\Field\\StringField',
  'widget' => '\\Metayogi\\Form\\Element\\UuidElement',
  'rdf:type' => 'rdf:properties',
  'qname' => '_id',
);
