<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

$views = array();

$views[] = array (
  '_id' => '52405fddf311fef81866c245',
  'label' => 'Works List',
  'display' => '\\Metayogi\\Display\\TableDisplay',
  'decorators' => array (
    'pre' => 
    array (
      0 => '\\Metayogi\\Decorator\\TitleDecorator',
      1 => '\\Metayogi\\Decorator\\CreateDecorator',
    ),
    'post' => 
    array (
      0 => '\\Metayogi\\Decorator\\PagerDecorator',
      1 => '\\Metayogi\\Decorator\\ConfirmDecorator',
    ),
  ),
  'TitleDecorator' => array (
    'label' => 'Works List',
  ),
  'TableDisplay' => array (
    'fieldset' => 
    array (
      '_id' => '52405fddf311fef81866c248',
      '_ref' => 'my:fieldsets',
    ),
  ),
  'rdf:type' => 'my:views',
);

$views[] = array (
  '_id' => '52405fddf311fef81866c246',
  'label' => 'Works Form',
  'display' => '\\Metayogi\\Display\\FormDisplay',
  'decorators' => array (
    'pre' => 
    array (
      0 => '\\Metayogi\\Decorator\\TitleDecorator',
    ),
  ),
  'TitleDecorator' => 
  array (
    'label' => 'Works Form',
  ),
  'FormDisplay' => 
  array (
    'layout' => 'form-horizontal',
    'help' => 'help-stacked',
    'elementset' => 
    array (
      '_id' => '52405fddf311fef81866c24b',
      '_ref' => 'my:fieldsets',
    ),
  ),
  'rdf:type' => 'my:views',
);

$views[] = array (
  '_id' => '52405fddf311fef81866c247',
  'label' => 'Works Display',
  'display' => '\\Metayogi\\Display\\RecordDisplay',
  'decorators' => 
  array (
    'pre' => 
    array (
      0 => '\\Metayogi\\Decorator\\TitleDecorator',
    ),
  ),
  'TitleDecorator' => 
  array (
    'label' => 'Works Display',
  ),
  'RecordDisplay' => 
  array (
    'fieldset' => 
    array (
      '_id' => '52405fddf311fef81866c24a',
      '_ref' => 'my:fieldsets',
    ),
  ),
  'rdf:type' => 'my:views',
);

/*
* Admin search
*/

$views[] = array (
  '_id' => '524c7c31f311fede35724064',
  'decorators' => 
  array (
    'pre' => 
    array (
      0 => 'Metayogi\\Components\\Core\\Search\\SearchFormDecorator',
      1 => 'Metayogi\\Components\\Core\\Search\\TermsDecorator',
      2 => 'Metayogi\\Decorator\\PagerDecorator',
    ),
  ),
  'display' => 'Metayogi\\Display\\ListDisplay',
  'TitleDecorator' => 
  array (
    'label' => 'Admin Search Results',
  ),
  'SearchFormDecorator' => 
  array (
    'layout' => 'form-inline',
    'elements' => 
    array (
      'index_term0' => 
      array (
        'widget' => 'Metayogi\\Form\\Element\\HiddenElement',
        'value' => 'any_t',
      ),
      'term0' => 
      array (
        'widget' => 'Metayogi\\Form\\Element\\InputElement',
      ),
      'cnt' => 
      array (
        'widget' => 'Metayogi\\Form\\Element\\HiddenElement',
        'value' => '1',
      ),
    ),
  ),
  'ListDisplay' => 
  array (
    'fieldsetName' => 'Brief',
  ),
  'controllerID' => '524c7c31f311fede35724063',
  'sformID' => '524c7c0ef311fedb35461675',
  'rdf:type' => 'my:views',
);

$views[] = array (
  '_id' => '524c7c31f311fede35724065',
  'decorators' => 
  array (
    'pre' => 
    array (
      0 => 'Metayogi\\Components\\Core\\Search\\SearchFormDecorator',
      1 => 'Metayogi\\Components\\Core\\Search\\TermsDecorator',
      2 => 'Metayogi\\Decorator\\PagerDecorator',
    ),
  ),
  'display' => 'Metayogi\\Display\\ListDisplay',
  'TitleDecorator' => 
  array (
    'label' => 'Admin Search Results',
  ),
  'SearchFormDecorator' => 
  array (
    'layout' => 'form-horizontal',
    'elements' => 
    array (
      'index_term0' => 
      array (
        'optionslist' => 
        array (
          'any_t' => 'Any field',
          'author_t' => 'Author',
          'title_t' => 'Title',
        ),
        'widget' => 'Metayogi\\Form\\Element\\SelectElement',
      ),
      'term0' => 
      array (
        'widget' => 'Metayogi\\Form\\Element\\InputElement',
      ),
      'index_term1' => 
      array (
        'optionslist' => 
        array (
          'any_t' => 'Any field',
          'author_t' => 'Author',
          'title_t' => 'Title',
        ),
        'widget' => 'Metayogi\\Form\\Element\\SelectElement',
      ),
      'term1' => 
      array (
        'widget' => 'Metayogi\\Form\\Element\\InputElement',
      ),
      'index_term2' => 
      array (
        'optionslist' => 
        array (
          'any_t' => 'Any field',
          'author_t' => 'Author',
          'title_t' => 'Title',
        ),
        'widget' => 'Metayogi\\Form\\Element\\SelectElement',
      ),
      'term2' => 
      array (
        'widget' => 'Metayogi\\Form\\Element\\InputElement',
      ),
      'cnt' => 
      array (
        'widget' => 'Metayogi\\Form\\Element\\HiddenElement',
        'value' => '3',
      ),
    ),
  ),
  'ListDisplay' => 
  array (
    'fieldsetName' => 'Brief',
  ),
  'controllerID' => '524c7c31f311fede35724063',
  'sformID' => '524c7c0ef311fedb35461675',
  'rdf:type' => 'my:views',
);

$views[] = array (
  '_id' => '524c7c31f311fede35724066',
  'display' => 'Metayogi\\Components\\Core\\Search\\SearchRecordDisplay',
  'decorators' => 
  array (
    'pre' => 
    array (
      0 => 'Metayogi\\Components\\Core\\Search\\SearchNavDecorator',
    ),
  ),
  'TitleDecorator' => 
  array (
    'label' => 'Admin Search Display',
  ),
  'SearchRecordDisplay' => 
  array (
    'fieldset' => 'Full',
  ),
  'controllerID' => '524c7c31f311fede35724063',
  'sformID' => '524c7c0ef311fedb35461675',
  'rdf:type' => 'my:views',
);