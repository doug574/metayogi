<?php

$views = array();

$views[] = array (
  '_id' => '51bb86f2f311fef826000014',
  'display' => '\\Metayogi\\Components\\Core\\Cache\\CacheDisplay',
  'decorators' => array (
    'pre' => array (
      0 => '\\Metayogi\\Decorator\\TitleDecorator',
    ),
    'post' => array (
      0 => '\\Metayogi\\Decorator\\ConfirmDecorator',
    ),
  ),
  'TitleDecorator' => array (
    'label' => 'Cache List',
  ),
  'CacheDisplay' => array (
  ),
  'controllerID' => '51bb86f2f311fef826000013',
  'rdf:type' => 'my:views',
);