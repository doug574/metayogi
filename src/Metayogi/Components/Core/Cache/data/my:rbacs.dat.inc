<?php

$rbacs = array();

$rbacs[] = array (
  '_id' => '51c7ef5bf311fe252d517e06',
  'controller' => '*.cache',
  'role' => 'Administrator',
  'actions' => array (
    0 => 'FlushAction',
    1 => 'ResetAction',
  ),
  'rdf:type' => 'my:rbacs',
);