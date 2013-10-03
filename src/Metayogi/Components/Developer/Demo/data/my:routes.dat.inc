<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

$routes = array();

$routes[] = array (
  '_id' => '52405fddf311fef81866c24c',
  'alias' => 'admin/work',
  'output' => 'html',
  'action' => '\\Metayogi\\Action\\ListAction',
  'layout' => array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' => array (
    '_id' => '52405fddf311fef81866c245',
    '_ref' => 'my:views',
  ),
  'model' => array (
    '_id' => '52405fc2f311fef7182f13bf',
    '_ref' => 'rdfs:classes',
  ),
  'controller' => array (
    '_id' => '52405fddf311fef81866c244',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '52405fddf311fef81866c24d',
  'alias' => 'admin/work/add',
  'output' => 'html',
  'action' => '\\Metayogi\\Action\\CreateAction',
  'layout' => array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' => array (
    '_id' => '52405fddf311fef81866c246',
    '_ref' => 'my:views',
  ),
  'model' => array (
    '_id' => '52405fc2f311fef7182f13bf',
    '_ref' => 'rdfs:classes',
  ),
  'controller' => array (
    '_id' => '52405fddf311fef81866c244',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '52405fddf311fef81866c24e',
  'alias' => 'admin/work/update',
  'output' => 'html',
  'action' => '\\Metayogi\\Action\\EditAction',
  'layout' => array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' => array (
    '_id' => '52405fddf311fef81866c246',
    '_ref' => 'my:views',
  ),
  'model' => array (
    '_id' => '52405fc2f311fef7182f13bf',
    '_ref' => 'rdfs:classes',
  ),
  'controller' => array (
    '_id' => '52405fddf311fef81866c244',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '52405fddf311fef81866c24f',
  'alias' => 'admin/work/delete',
  'output' => 'html',
  'action' => '\\Metayogi\\Action\\DeleteAction',
  'layout' => array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'model' => array (
    '_id' => '52405fc2f311fef7182f13bf',
    '_ref' => 'rdfs:classes',
  ),
  'controller' => array (
    '_id' => '52405fddf311fef81866c244',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '52405fddf311fef81866c250',
  'alias' => 'admin/work/display',
  'output' => 'html',
  'action' => '\\Metayogi\\Action\\LoadAction',
  'layout' => array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' => array (
    '_id' => '52405fddf311fef81866c247',
    '_ref' => 'my:views',
  ),
  'model' => array (
    '_id' => '52405fc2f311fef7182f13bf',
    '_ref' => 'rdfs:classes',
  ),
  'controller' => array (
    '_id' => '52405fddf311fef81866c244',
    '_ref' => 'my:controllers',
  ),
  'rdf:type' => 'my:routes',
);

/* 
* Admin search
*/

$routes[] = array (
  '_id' => '524c7c31f311fede35724067',
  'alias' => 'admin/works/search',
  'output' => 'html',
  'action' => 'Metayogi\\Components\\Core\\Search\\SearchAction',
  'layout' => array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' => array (
    '_id' => '524c7c31f311fede35724064',
    '_ref' => 'my:views',
  ),
  'model' => array (
    '_id' => '524c7c0ef311fedb35461675',
    '_ref' => 'my:sforms',
  ),
  'controller' => array (
    '_id' => '524c7c31f311fede35724063',
    '_ref' => 'my:controllers',
  ),
  'parameters' => array (
    'pagesize' => 10,
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '524c7c31f311fede35724068',
  'alias' => 'admin/works/advanced',
  'output' => 'html',
  'action' => 'Metayogi\\Components\\Core\\Search\\SearchAction',
  'layout' => array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' => array (
    '_id' => '524c7c31f311fede35724065',
    '_ref' => 'my:views',
  ),
  'model' => array (
    '_id' => '524c7c0ef311fedb35461675',
    '_ref' => 'my:sforms',
  ),
  'controller' => array (
    '_id' => '524c7c31f311fede35724063',
    '_ref' => 'my:controllers',
  ),
  'parameters' => array (
    'pagesize' => 10,
  ),
  'rdf:type' => 'my:routes',
);

$routes[] = array (
  '_id' => '524c7c31f311fede35724069',
  'alias' => 'admin/works/record',
  'output' => 'html',
  'action' => 'Metayogi\\Components\\Core\\Search\\SearchAction',
  'layout' => array (
    '_id' => '4eda94436c10ba3216000000',
    '_ref' => 'my:layouts',
  ),
  'view' => array (
    '_id' => '524c7c31f311fede35724066',
    '_ref' => 'my:views',
  ),
  'model' => array (
    '_id' => '524c7c0ef311fedb35461675',
    '_ref' => 'my:sforms',
  ),
  'controller' => array (
    '_id' => '524c7c31f311fede35724063',
    '_ref' => 'my:controllers',
  ),
  'parameters' => array (
    'pagesize' => 10,
  ),
  'rdf:type' => 'my:routes',
);