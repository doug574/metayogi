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
 
/**
 *  Adds non-ID actions to operation displays
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class TermsDecorator extends BaseDecorator implements DecoratorInterface
{
    protected $terms;

    /**
    * {@inheritdoc}
    */
    public function build()
    {
        $this->terms = "";
        if ($this->data->has('params.fq')) {
            $this->terms = $this->data->get('params.fq');
        }
    }

    /**
    * {@inheritdoc}
    */
    public function render()
    {
        $html = "<div>$this->terms</div>";
        
        return $html;
    }
}
