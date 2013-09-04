<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Components\Core\ComponentManager;

use Metayogi\Foundation\Kernel;

/**
 * Uninstalls a component
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class UninstallAction extends BaseAction implements ActionInterface
{
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $plugin = $this->router->getRoute('instance.name') . 'Plugin';
        $pluginClass::uninstall($this->dbh);
        $this->mediator->dispatch(Kernel::ACTION_POST, $this->event);
        
        return array();
    }
}
