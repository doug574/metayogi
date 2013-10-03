<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Components\Core\Search;

use Metayogi\Decorator\BaseDecorator;
use Metayogi\Decorator\DecoratorInterface;
use Metayogi\Form\Container\FormContainer; 

/**
 *  Adds non-ID actions to operation displays
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class SearchFormDecorator extends BaseDecorator implements DecoratorInterface
{
    /** desc */
    public $form;

    /**
    * {@inheritdoc}
    */
    public function build()
    {
        $properties = $this->router->get('view.SearchFormDecorator');
		$properties['method'] = 'get';
        $properties['elements']['submitButton'] = array (
            'widget' => '\\Metayogi\\Form\\Element\\ButtonElement',
			'type' => 'submit',
			'class' => 'btn',
			'value' => 'Search',
		);

		$this->form = new FormContainer($this->dbh, $this->router, $this->registry, $this->viewer, $this->data);
        $this->form->build($properties);
    }

    /**
    * {@inheritdoc}
    */
    public function render()
    {
 		return $this->form->render();
    }
}
