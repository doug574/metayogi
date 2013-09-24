<?php

$classes = array();

$classes[] = array (
  '_id' => '51a79a04f311fe4038000003',
  'name' => 'object',
  'label' => 'Object',
  'domain' => 'my',
  'abstract' => '1',
  'comment' => 'This is the class of everything. All other classes are subclasses of this class',
  'properties' => array (
    '_id' => array (
	  '0' => '51a79b71f311fe3b38000019',
      '1' => '50e48562f311fe7d5400003b',
    ),
    '_ref' => 'rdf:properties',
  ),
  'qname' => 'my:object',
  'rdf:type' => 'rdfs:classes',
);

$classes[] = array (
  '_id' => '50c0f9f7f311fed270000056',
  'name' => 'entity',
  'label' => 'Entity',
  'domain' => 'my',
  'comment' => 'Base class for all classes with mutable instances',
  'properties' => array (
    '_id' => array (
      0 => '50c24967f311fed670000067',
      1 => '50c24984f311fed270000086',
      2 => '50e4868af311fe7f5400002b',
	  3 => '519e95d6f311fec14382932c',
	  4 => '519e9660f311febc43651a58',
    ),
    '_ref' => 'rdf:properties',
  ),
  'qname' => 'my:entity',
  'abstract' => 1,
  'rdf:type' => 'rdfs:classes',
);
