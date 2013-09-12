<?php

$layouts = array();

$layouts[] = array (
  '_id' => '4eda94436c10ba3216000000',
  'routes' => 'admin',
  'output' => 'html',
  'layout' => 'fixed',
  'label' => 'Default admin layout',
  'theme' => array (
    '_id' => '506a85000de404f60d00000b',
    '_ref' => 'my:themes',
  ),
  'regions' => array (
   '_id' => array (
      0 => '4edadc506c10ba5a15030000',
      1 => '4f5c575af311fe1f17000000',
      2 => '4edadce36c10ba5915020000',
    ),
    '_ref' => 'my:regions',
  ),
  'rdf:type' => 'my:layouts',
);

$layouts[] = array (
  '_id' => '506be69e0de404f30d00001c',
  'layout' => 'fixed',
  'label' => 'Default public layout',
  'theme' => array (
    '_id' => '506a85000de404f60d00000b',
    '_ref' => 'my:themes',
  ),
  'regions' => array (
    '_id' => array (
      0 => '506be6ef0de404ef0d00000f',
      1 => '506be7db0de404ef0d000010',
      2 => '506be7500de404f10d000026',
    ),
    '_ref' => 'my:regions',
  ),
  'rdf:type' => 'my:layouts',
);
