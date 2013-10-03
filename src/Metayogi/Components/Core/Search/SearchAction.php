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
class SearchAction extends BaseAction implements ActionInterface
{
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $attrs['pagesize'] = $this->router->get('params.pagesize');
        $attrs['pagenum'] = $this->router->get('params.pagenum');

        $terms = "";
        $cnt = $this->request->query->get('cnt');
        for ($i=0; $i<$cnt; $i++) {
			$idx = $this->request->query->get('index_term' . $i);
			$term = $this->request->query->get('term' . $i);
			if ($term != "") {
				$terms .= " $idx:$term";
			}
        }

		/*
		* If no search terms, use default
		*/
        if ($terms == "") {
#			if (! empty($app->route['view']['mySearchFormDecorator']['default'])) {
#				foreach ($app->route['view']['mySearchFormDecorator']['default'] as $idx => $term) {
#					$terms .= " $idx:\"$term\"";
#				}
#			} else {
				$terms = "*:*";
#			}
			
		}

        $facets = array();
        
        /*
        * Run query
        */
        $results = $this->search->query($terms, $facets, $attrs);

        /*
        *  Load records into data result
        */
        if (! empty($results['docs'])) {
            $docs = $results['docs'];
            $results['docs'] = array();
            foreach ($docs as $doc) {
                $results['docs'][] = $this->dbh->load($doc['recordType_s'][0], $doc['id'], $this->registry->get('cache'));
            }
        }
        $this->data->setStore($results);
        
        $this->mediator->dispatch(Kernel::ACTION_POST, $this->event);
    }
}
