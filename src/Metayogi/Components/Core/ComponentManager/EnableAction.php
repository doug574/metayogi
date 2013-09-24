<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Components\Core\ComponentManager;

use Metayogi\Foundation\Kernel;
use Metayogi\Action\BaseAction;
use Metayogi\Action\ActionInterface;

/**
 * Installs a component
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class EnableAction extends BaseAction implements ActionInterface
{
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $component = $this->router->getInstance();
        $pluginClass = $component['namespace'] . '\\' . $component['name'] . 'Plugin';
        $pluginClass::enable($this->dbh, $this->registry);

        $this->mediator->dispatch(Kernel::ACTION_POST, $this->event);
    }
}
