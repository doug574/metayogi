<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Components\Core\Search;

use Metayogi\Action\BaseAction;
use Metayogi\Action\ActionInterface;
use Metayogi\Foundation\Kernel;
 
/**
 * Loads a record from in a collection
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class ReindexAction extends BaseAction implements ActionInterface
{
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $this->search->removeAll();

        $classes = $this->dbh->query('rdfs:classes');        
        if ($classes['numFound'] > 0) {
            foreach ($classes['docs'] as $rdfsClass) {
                $controllers = $this->dbh->query('my:controllers', array('collection' => $rdfsClass['qname']));
                if ($controllers['numFound'] > 0) {    
                    $controller = $controllers['docs'][0];
                    $collection = $controller['collection'];
                    if (isset($controller['behaviours']['Search']) && $controller['behaviours']['Search'] == 1) {
                        $this->search->addCollection($this->dbh, $collection, $this->registry->get('cache'));
                    }
                }
            }
        }
exit;        
        $this->mediator->dispatch(Kernel::ACTION_POST, $this->event);
    }
}
