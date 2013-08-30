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
 * Lists records in a collection
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class LoadAction extends BaseAction implements ActionInterface
{
    /**
     * Description
     *
     * @param object $app Description
     *
     * @return void
     */
    public function run()
    {
        $route = $this->router->getRoute();
        if (empty($route['instanceID'])) {
            throw new \Exception('No instanceID');
        }
        $collection = $route['controller']['instances'];
        $data = $this->dbh->load($collection, $route['instanceID'], $this->registry->get('cache'));
        $this->mediator->dispatch(Kernel::ACTION_POST, $this->event);

        return $data;
    }

}