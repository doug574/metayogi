<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Form\Element;

use Metayogi\Form\BaseWidget;
use Metayogi\Form\WidgetInterface;

/**
 * desc
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class EnumerationElement extends SelectElement
{
    /**
    * {@inheritdoc}
    */
    public function build($properties)
    {
 		parent::build($properties);
		$result = $this->dbh->load('my:enumerations', $properties['enumerationID']);
		$this->list = $result['list'];
    }
}