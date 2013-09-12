<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Action;

use Metayogi\Foundation\Kernel;
 
/**
 * Loads a record from in a collection
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class LoadAction extends BaseAction implements ActionInterface
{
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $data = $this->router->getInstance();
        $this->mediator->dispatch(Kernel::ACTION_POST, $this->event);

        return $data;
    }
}
