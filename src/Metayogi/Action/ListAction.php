<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Action;
 
/**
 * Lists records in a collection
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class ListAction extends BaseAction implements ActionInterface
{
    /**
     * Description
     *
     * @return void
     */
    public function run()
    {
        $collection = $this->router->getRoute('controller.instances');
        $results = $this->dbh->query($collection);
        
        return $results;
    }
}