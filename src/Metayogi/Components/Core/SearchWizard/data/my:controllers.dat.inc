<?php

$controllers = array();

$controllers[] = array (
  '_id' => '50502f1ef311fee77b000000',
  'name' => 'index',
  'label' => 'Search Index',
  'collection' => 'my:indexes',
  'CRUDpath' => 'admin/indexes',
  'actions' => array (
    'ListAction' => 'admin/indexes',
    'CreateAction' => 'admin/indexes/add',
    'EditAction' => 'admin/indexes/update',
    'DeleteAction' => 'admin/indexes/delete',
  ),
  'listeners' => array (
    'model' => array (
      '525467a9f311fea47ace5ac2' => array (
        'action' => '\\Metayogi\\Action\\ListAction',
        'event' => 'action.pre',
        'listener' => '\\Metayogi\\Listener\\FilterListener',
      ),
      '525467bff311fe9c3e15756a' => array (
        'action' => '\\Metayogi\\Action\\DeleteAction',
        'event' => 'action.post',
        'listener' => '\\Metayogi\\Listener\\RedirectListener',
        'priority' => -100,
      ),
      '525467c3f311fea57af09d78' => array (
        'action' => '\\Metayogi\\Action\\CreateAction',
        'event' => 'action.post',
        'listener' => '\\Metayogi\\Listener\\RedirectListener',
        'priority' => -100,
      ),
      '525467c7f311fea47a8af589' => array (
        'action' => '\\Metayogi\\Action\\CreateAction',
        'event' => 'action.cancel',
        'listener' => '\\Metayogi\\Listener\\RedirectListener',
        'priority' => -100,
      ),
      '525467cbf311fe9c3ea3c0cf' => array (
        'action' => '\\Metayogi\\Action\\EditAction',
        'event' => 'action.post',
        'listener' => '\\Metayogi\\Listener\\RedirectListener',
        'priority' => -100,
      ),
      '525467d1f311fea57a54b550' => array (
        'action' => '\\Metayogi\\Action\\EditAction',
        'event' => 'action.cancel',
        'listener' => '\\Metayogi\\Listener\\RedirectListener',
        'priority' => -100,
      ),
    ),
  ),
  'rdf:type' => 'my:controllers',
);


$controllers[] = array (
  '_id' => '506d99cb0de404f30d000055',
  'name' => 'sforms',
  'label' => 'Search Form',
  'collection' => 'my:sforms',
  'CRUDpath' => 'admin/sforms',
  'actions' => array (
    'ListAction' => 'admin/sforms',
    'CreateAction' => 'admin/sforms/add',
    'EditAction' => 'admin/sforms/update',
    'DeleteAction' => 'admin/sforms/delete',
  ),
  'listeners' => array (
    'model' => array (
      '525469bff311fe9f7a0440e4' => array (
        'action' => '\\Metayogi\\Action\\ListAction',
        'event' => 'action.pre',
        'listener' => '\\Metayogi\\Listener\\FilterListener',
      ),
      '525469c4f311fea17aef58a5' => array (
        'action' => '\\Metayogi\\Action\\DeleteAction',
        'event' => 'action.post',
        'listener' => '\\Metayogi\\Listener\\RedirectListener',
        'priority' => -100,
      ),
      '525469c9f311fe9e7a097517' => array ( 
        'action' => '\\Metayogi\\Action\\DeleteAction',
        'event' => 'action.post',
        'listener' => '\\Metayogi\\Components\\Core\\SearchWizard\\SearchFormListener',
        'method' => 'onDelete'
      ), 
      '525469cef311fe9f7aa1fdc2' => array (
        'action' => '\\Metayogi\\Action\\CreateAction',
        'event' => 'action.post',
        'listener' => '\\Metayogi\\Listener\\RedirectListener',
        'priority' => -100,
      ),
      '525469d3f311fea17a80f7e2' => array (
        'action' => '\\Metayogi\\Action\\CreateAction',
        'event' => 'action.cancel',
        'listener' => '\\Metayogi\\Listener\\RedirectListener',
        'priority' => -100,
      ),
      '525469d7f311fe9e7accfbd7' => array (
        'action' => '\\Metayogi\\Action\\CreateAction',
        'event' => 'action.post',
        'listener' => '\\Metayogi\\Components\\Core\\SearchWizard\\SearchFormListener',
        'method' => 'onCreate'
      ),
      '525469dbf311fe9f7a54f494' => array (
        'action' => '\\Metayogi\\Action\\EditAction',
        'event' => 'action.post',
        'listener' => '\\Metayogi\\Listener\\RedirectListener',
        'priority' => -100,
      ),
      '525469dff311fea17a3dc514' => array (
        'action' => '\\Metayogi\\Action\\EditAction',
        'event' => 'action.cancel',
        'listener' => '\\Metayogi\\Listener\\RedirectListener',
        'priority' => -100,
      ),
      '525469e4f311fe9e7a2a063b' => array (
        'action' => '\\Metayogi\\Action\\EditAction',
        'event' => 'action.post',
        'listener' => '\\Metayogi\\Components\\Core\\SearchWizard\\SearchFormListener',
        'method' => 'onUpdate'
      ),
    ),
  ),
  'rdf:type' => 'my:controllers',
);

