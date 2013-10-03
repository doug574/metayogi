<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

$indexes = array();

$indexes[] = array (
  '_id' => '524c7b6bf311fedd352ea788',
  'name' => 'any',
  'label' => 'Any field',
  'type' => '_t',
  'properties' => array (
    '_id' => array (
      0 => '52405f51f311fefe18db36e0',
      1 => '52405f7ef311fe0219f51670',
      2 => '52405fa0f311feff185e59f3',
      3 => '524c7992f311fed735bdb52d',
      4 => '524c79b8f311feda35a0254a',
    ),
    '_ref' => 'rdf:properties',
  ),
  'rdf:type' => 'my:indexes',
);

$indexes[] = array (
  '_id' => '524c7b90f311fedc35188812',
  'name' => 'author',
  'label' => 'Author',
  'type' => '_t',
  'properties' => array (
    '_id' => array (
      0 => '52405f7ef311fe0219f51670',
    ),
    '_ref' => 'rdf:properties',
  ),
  'rdf:type' => 'my:indexes',
);

$indexes[] = array (
  '_id' => '524c7bb8f311feda35b0f111',
  'name' => 'title',
  'label' => 'Title',
  'type' => '_t',
  'properties' => array (
    '_id' => array (
      0 => '52405f51f311fefe18db36e0',
    ),
    '_ref' => 'rdf:properties',
  ),
  'rdf:type' => 'my:indexes',
);

$indexes[] = array (
  '_id' => '524c7bd7f311fede35fa663e',
  'name' => 'genre',
  'label' => 'Genre',
  'type' => '_s',
  'properties' => array (
    '_id' => array (
      0 => '524c79b8f311feda35a0254a',
    ),
    '_ref' => 'rdf:properties',
  ),
  'rdf:type' => 'my:indexes',
);

$indexes[] = array (
  '_id' => '524c7beaf311fed7350b0089',
  'name' => 'year',
  'label' => 'Year',
  'type' => '_s',
  'properties' => array (
    '_id' => array (
      0 => '524c7992f311fed735bdb52d',
    ),
    '_ref' => 'rdf:properties',
  ),
  'rdf:type' => 'my:indexes',
);