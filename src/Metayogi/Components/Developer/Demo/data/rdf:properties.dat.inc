<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

$properties = array();

$properties[] = array (
  '_id' => '52405f51f311fefe18db36e0',
  'name' => 'title',
  'label' => 'Title',
  'domain' => 'ssu',
  'comment' => '',
  'propertyType' => 'Literal',
  'range' => 'xsd:string',
  'collection' => '',
  'required' => 1,
  'repeatable' => 0,
  'unique' => 0,
  'immutable' => 0,
  'gadget' => '\\Metayogi\\Field\\StringField',
  'widget' => '\\Metayogi\\Form\\Element\\InputElement',
  'rdf:type' => 'rdf:properties',
  'qname' => 'ssu:title',
);

$properties[] = array (
  '_id' => '52405f7ef311fe0219f51670',
  'name' => 'author',
  'label' => 'Author(s)',
  'domain' => 'ssu',
  'comment' => '',
  'propertyType' => 'Literal',
  'range' => 'xsd:string',
  'collection' => '',
  'required' => 0,
  'repeatable' => 1,
  'unique' => 0,
  'immutable' => 0,
  'gadget' => '\\Metayogi\\Field\\StringField',
  'widget' => '\\Metayogi\\Form\\Element\\InputElement',
  'rdf:type' => 'rdf:properties',
  'qname' => 'ssu:author',
);

$properties[] = array (
  '_id' => '52405fa0f311feff185e59f3',
  'name' => 'summary',
  'label' => 'Summary',
  'domain' => 'ssu',
  'comment' => '',
  'propertyType' => 'Literal',
  'range' => 'xsd:string',
  'collection' => '',
  'required' => 0,
  'repeatable' => 0,
  'unique' => 0,
  'immutable' => 0,
  'gadget' => '\\Metayogi\\Field\\TextField',
  'widget' => '\\Metayogi\\Form\\Element\\TextAreaElement',
  'rdf:type' => 'rdf:properties',
  'qname' => 'ssu:summary',
);

$properties[] = array (
  '_id' => '524c7992f311fed735bdb52d',
  'name' => 'year',
  'label' => 'Year',
  'domain' => 'ssu',
  'comment' => '',
  'propertyType' => 'Literal',
  'range' => 'xsd:string',
  'collection' => '',
  'required' => 0,
  'repeatable' => 0,
  'unique' => 0,
  'immutable' => 0,
  'gadget' => '\\Metayogi\\Field\\StringField',
  'widget' => '\\Metayogi\\Form\\Element\\InputElement',
  'rdf:type' => 'rdf:properties',
  'qname' => 'ssu:year',
);

$properties[] = array (
  '_id' => '524c79b8f311feda35a0254a',
  'name' => 'genre',
  'label' => 'Genre',
  'domain' => 'ssu',
  'comment' => '',
  'propertyType' => 'Literal',
  'range' => 'xsd:string',
  'collection' => '',
  'required' => 0,
  'repeatable' => 1,
  'unique' => 0,
  'immutable' => 0,
  'gadget' => '\\Metayogi\\Field\\StringField',
  'widget' => '\\Metayogi\\Form\\Element\\InputElement',
  'rdf:type' => 'rdf:properties',
  'qname' => 'ssu:genre',
);