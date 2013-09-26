<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Components\Core\Controller;

use Metayogi\Foundation\Kernel;
use Metayogi\Action\BaseAction;
use Metayogi\Action\ActionInterface;

/**
 * Installs a component
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class ToggleAction extends BaseAction implements ActionInterface
{
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $behaviour = $this->request->query->get('bid');
        $state = $this->request->query->get('state');
        $properties = $this->registry->get("behaviours.$behaviour");
        $pluginClass = $properties['namespace'] . $behaviour . 'Plugin';
        if ($state == 'off') {
            $pluginClass::enable($this->dbh, $this->registry, $this->router);
        } else {
            $pluginClass::disable($this->dbh, $this->registry, $this->router);
        }

        $this->mediator->dispatch(Kernel::ACTION_POST, $this->event);
    }
}
