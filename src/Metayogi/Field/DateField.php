<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Field;

/**
 * Defines the Date Field class
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class DateField extends BaseField implements FieldInterface
{
	/**
     * Description
     *
     * @param array $properties Description
     * @param array $doc        Desc
     *
     * @return void
     * @access public
     */
    public function build($properties, $doc)
    {
        parent::build($properties, $doc);
	}
}
