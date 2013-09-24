<?php

$indexes = array();

$indexes[] = array (
  '_id' => '50e485def311fe7a54000029',
  'name' => 'recordType',
  'label' => 'Record type',
  'type' => '_s',
  'properties' => array (
    '_id' => array (
      0 => '50e48562f311fe7d5400003b',
    ),
    '_ref' => 'rdf:properties',
  ),
  'rdf:type' => 'my:indexes',
);

$indexes[] = array (
  '_id' => '50e48731f311fe7e54000039',
  'name' => 'live',
  'label' => 'Live',
  'type' => '_b',
  'properties' => array (
    '_id' => array (
      0 => '50e4868af311fe7f5400002b',
    ),
    '_ref' => 'rdf:properties',
  ),
  'rdf:type' => 'my:indexes',
);

$indexes[] = array (
  '_id' => '50e4874ff311fe7b54000028',
  'name' => 'createdDate',
  'label' => 'Date created',
  'type' => '_l',
  'properties' => array (
    '_id' => array (
      0 => '50c24967f311fed670000067',
    ),
    '_ref' => 'rdf:properties',
  ),
  'rdf:type' => 'my:indexes',
);

$indexes[] = array (
  '_id' => '50e48763f311fe7a5400002c',
  'name' => 'modifiedDate',
  'label' => 'Date last modified',
  'type' => '_l',
  'properties' => array (
    '_id' => array (
      0 => '50c24984f311fed270000086',
    ),
    '_ref' => 'rdf:properties',
  ),
  'rdf:type' => 'my:indexes',
);

$indexes[] = array (
  '_id' => '519f1138f311fec043d013a9',
  'name' => 'createdBy',
  'label' => 'Created by',
  'type' => '_s',
  'properties' => array (
    '_id' => array (
      0 => '519e95d6f311fec14382932c',
    ),
    '_ref' => 'rdf:properties',
  ),
  'rdf:type' => 'my:indexes',
);

$indexes[] = array (
  '_id' => '519f1157f311febd43547489',
  'name' => 'modifiedBy',
  'label' => 'Modified by',
  'type' => '_s',
  'properties' => array (
    '_id' => array (
      0 => '519e9660f311febc43651a58',
    ),
    '_ref' => 'rdf:properties',
  ),
  'rdf:type' => 'my:indexes',
);

$indexes[] = array (
  '_id' => '51c0d346f311fe4d56f86175',
  'name' => 'id',
  'label' => 'Identifier',
  'type' => '',
  'properties' => array (
    '_id' => array (
      0 => '51a79b71f311fe3b38000019',
    ),
    '_ref' => 'rdf:properties',
  ),
  'rdf:type' => 'my:indexes',
);
