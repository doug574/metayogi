<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Components\Core\Search;

use Metayogi\Foundation\Kernel;
use Metayogi\Components\Core\ComponentManager\PluginInterface;
use Metayogi\Components\Core\ComponentManager\PluginHelper;
use Metayogi\Database\DatabaseInterface;
use Metayogi\Foundation\Registry;
use Metayogi\Routing\Router;

/**
 * Class of static methods for installing/uninstalling this component.
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class SearchPlugin implements PluginInterface
{
    /** Entity ID for this component in the Components collection */
    protected static $uuid = '513057f0f311fe6416000006';

    /** Files of entities installed/uninstalled with this componnt */
    protected static $datafiles = array(/*'my:rbacs'*/);

    /**
     * Description
     *
     * @return array
     * @access public
     */
    public static function info()
    {
        return array(
            '_id' => self::$uuid,
            'name' => 'Search',
            'label' => 'Search',
            'namespace' => __NAMESPACE__,
            'description' => 'Makes entities searchable',
            'requires' => array('ModelWizard', 'ViewWizard'),
            'category' => 'Core',
            'behaviour' => 1,
            'configurable' => 1,
            );
    }

    /**
     * Install this component
     *
     * @access public
     * @param Metayogi\Database\DatabaseInterface $dbh
     * @param Metayogi\Foundation\Registry        $registry
     * @return void
     */
    public static function install(DatabaseInterface $dbh, Registry $registry)
    {
        PluginHelper::addData($dbh, self::$datafiles, dirname(__FILE__) . '/data/');
        $dbh->set(Kernel::COMPONENT_COLLECTION, self::$uuid, 'enabled', '1');

        $registry->reload();

        /* Behaviours */
        $registry->set('behaviours.Search', array(
            'namespace' => __NAMESPACE__ . '\\',
        ));
        
        /* Actions */
        $registry->set('actions.SearchAction', array (
            'namespace' => __NAMESPACE__ . '\\',
            'params' => array (
                'pagesize' => 10,
                'pagenum' => 0,
                ),
            )
        );
        $registry->set('actions.ReindexAction', array (
            'namespace' => __NAMESPACE__ . '\\',
        ));
        $registry->set('actions.HistoryAction', array (
            'namespace' => __NAMESPACE__ . '\\',
        ));

        $registry->save();

		/*
		*  Views
		*/
        /*
        $app->dbh->set(myKernelPlugin::REGISTRY_COLLECTION, myKernelPlugin::REGISTRY_ROOT, 'views.SearchResultsDisplay',
			array(
				'has' => 'fields', 
				'uses' => 'gadgets',
				'defaults' => array (
				  'fieldset' => 'brief',
				  'pagesize' => '10',
				  'displaylabels' => '1',
				  'numberedresults' => '1',
				  'titlelinked' => '1',
				),
			    'elements' => array (
					'mySearchResultsDisplay/pagesize' => array (
						'label' => 'Results size',
						'widget' => 'myInputElement',
						'comment' => 'The maximum number of documents to return at a time',
					),
					'mySearchResultsDisplay/fieldset' => array (
                      'label' => 'Fieldset',
                      'widget' => 'mySelectElement',
                      'optionslist' => array (
                        0 => 'brief',
                        1 => 'full',
                        2 => 'list',
                        3 => 'brief_admin',
                        4 => 'full_admin',
                        5 => 'list_admin',
                        6 => 'form',
                      ),
                      'comment' => 'Fieldset',
                    ),
					'mySearchResultsDisplay/displaylabels' => array (
						'label' => 'Field labels',
						'widget' => 'myCheckBoxElement',
						'comment' => 'Display field labels in results displays',
					),
					'mySearchResultsDisplay/numberedresults' => array (
						'label' => 'Numbered results',
						'widget' => 'myCheckBoxElement',
						'comment' => 'Display the number of each result',
					),
					'mySearchResultsDisplay/titlelinked' => array (
						'label' => 'Link title',
						'widget' => 'myCheckBoxElement',
						'comment' => 'Link title field of brief result to full result',
					),
				),
			)
		);
        $app->dbh->set(myKernelPlugin::REGISTRY_COLLECTION, myKernelPlugin::REGISTRY_ROOT, 'views.SearchRecordDisplay',
			array(
				'has' => 'fields', 
				'uses' => 'gadgets',
				'defaults' => array (
				  'fieldset' => 'full',
				),
			    'elements' => array (
					'mySearchRecordDisplay/fieldset' => array (
                      'label' => 'Fieldset',
                      'widget' => 'mySelectElement',
                      'optionslist' => array (
                        0 => 'brief',
                        1 => 'full',
                        2 => 'list',
                        3 => 'brief_admin',
                        4 => 'full_admin',
                        5 => 'list_admin',
                        6 => 'form',
                      ),
                      'comment' => 'Fieldset',
                    ),
				),
			)
		);
		*/
		/*
		* Decorators
		*/
        /*
        $app->dbh->set(myKernelPlugin::REGISTRY_COLLECTION, myKernelPlugin::REGISTRY_ROOT, 'decorators.FacetDecorator',
			array (
				'pre' => '1',
				'post' => '0',
				'defaults' => array (
				  'facetlimit' => '10',
				  'facetminsize' => '1',
				  'facetsort' => '1',
				),
				'elements' => array (
					'myFacetDecorator/facetlimit' => array (
						'label' => 'Facet limit',
						'widget' => 'myInputElement',
						'comment' => 'The maximum number of items that should be returned for the facet fields',
					),
					'myFacetDecorator/facetminsize' => array (
						'label' => 'Facet min size',
						'widget' => 'myInputElement',
						'comment' => 'The minimum count for facet items to be included in a search response',
					),
					'myFacetDecorator/facetsort' => array (
						'label' => 'Facet sort',
						'widget' => 'myInputElement',
						'comment' => 'Determines the ordering of the facet field items',
					),
				),
			)
		);
        $app->dbh->set(myKernelPlugin::REGISTRY_COLLECTION, myKernelPlugin::REGISTRY_ROOT, 'decorators.TermsDecorator', array('pre' => '1', 'post' => '0'));
        $app->dbh->set(myKernelPlugin::REGISTRY_COLLECTION, myKernelPlugin::REGISTRY_ROOT, 'decorators.SearchFormDecorator', array('pre' => '1', 'post' => '0'));
        $app->dbh->set(myKernelPlugin::REGISTRY_COLLECTION, myKernelPlugin::REGISTRY_ROOT, 'decorators.SearchNavDecorator', array('pre' => '1', 'post' => '0'));
*/
		/*
		* Menu items
		*/
        /*
        $app->dbh->push('my:menus', '50080fcef311fef627000002', 'menuitems.2manage.menuitems', array(
            'method' => 'link',
            'menuitemtitle' => 'Reindex',
            'menuitempath' => 'admin/reindex'
        ));
*/
    }

    /**
     * Uninstall this component
     *
     * @access public
     * @param Metayogi\Database\DatabaseInterface $dbh
     * @param Metayogi\Foundation\Registry        $registry
     * @return void
     */
    public static function uninstall(DatabaseInterface $dbh, Registry $registry)
    {
        PluginHelper::removeData($dbh, self::$datafiles, dirname(__FILE__) . '/data/');
        $dbh->set(Kernel::COMPONENT_COLLECTION, self::$uuid, 'enabled', '0');
/*
        $client = new mySolrSearch();
        $client->resetIndexes();
*/
    }

    /**
     * Description
     *
     * @access public
     * @param Metayogi\Database\DatabaseInterface $dbh
     * @param Metayogi\Foundation\Registry        $registry
     * @param use Metayogi\Routing\Router         $router
     * @return void
     */
    public static function enable(DatabaseInterface $dbh, Registry $registry, Router $router)
    {
        $instance = $router->getInstance();
        $controllerID = (string) $instance['_id'];
        $dbh->push('my:controllers', $controllerID, 'listeners.\\Metayogi\\Action\\DeleteAction', array (
            'event' => 'action.pre',
            'listener' => '\\Metayogi\\Components\\Core\\Search\\SearchListener',
            'method' => 'onDelete',
        ));
        $dbh->push('my:controllers', $controllerID, 'listeners.\\Metayogi\\Action\\EditAction', array (
            'event' => 'action.post',
            'listener' => '\\Metayogi\\Components\\Core\\Search\\SearchListener',
            'method' => 'onSave',
        ));
        $dbh->push('my:controllers', $controllerID, 'listeners.\\Metayogi\\Action\\CreateAction', array (
            'event' => 'action.post',
            'listener' => '\\Metayogi\\Components\\Core\\Search\\SearchListener',
            'method' => 'onSave',
        ));
        $dbh->set('my:controllers', $controllerID, 'behaviours.Search', 1);
    }

    /**
     * Description
     *
     * @access public
     * @param Metayogi\Database\DatabaseInterface $dbh
     * @param Metayogi\Foundation\Registry        $registry
     * @param use Metayogi\Routing\Router         $router
     * @return void
     */
    public static function disable(DatabaseInterface $dbh, Registry $registry, Router $router)
    {
        $instance = $router->getInstance();
        $controllerID = (string) $instance['_id'];
        $dbh->pull('my:controllers', $controllerID, 'listeners.\\Metayogi\\Action\\DeleteAction', array (
            'event' => 'action.pre',
            'listener' => '\\Metayogi\\Components\\Core\\Search\\SearchListener',
            'method' => 'onDelete',
        ));
        $dbh->pull('my:controllers', $controllerID, 'listeners.\\Metayogi\\Action\\EditAction', array (
            'event' => 'action.post',
            'listener' => '\\Metayogi\\Components\\Core\\Search\\SearchListener',
            'method' => 'onSave',
        ));
        $dbh->pull('my:controllers', $controllerID, 'listeners.\\Metayogi\\Action\\CreateAction', array (
            'event' => 'action.post',
            'listener' => '\\Metayogi\\Components\\Core\\Search\\SearchListener',
            'method' => 'onSave',
        ));
        $dbh->set('my:controllers', $controllerID, 'behaviours.Search', 0);
    }

    /**
     * Description
     *
     * @param object $app Description
     *
     * @return void
     * @access public
     */
    public static function configure($app)
    {
        return array (
            'elements' => array (
				'solrHost' => array (
                    'label' => 'Host',
                    'widget' => 'myInputElement',
                ),
				'solrPort' => array (
                    'label' => 'Port',
                    'widget' => 'myInputElement',
                ),
				'solrPath' => array (
                    'label' => 'Path',
                    'widget' => 'myInputElement',
                ),
            ),
        );
    }

}
