<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Field;

/**
 * Defines the Boolean Field class
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class BooleanField extends BaseField implements FieldInterface
{
    /**
    * {@inheritdoc}
    */
    public function build($properties, $doc)
    {
        $this->value = false;
        parent::build($properties, $doc);
    }
}
