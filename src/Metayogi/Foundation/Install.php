<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Foundation;

/**
 * Class of static methods for installing application.
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class Install
{
    /**
     * Description
     *
     * @return void
     * @access public
     */
    public static function install($dbh, $registry)
    {
        /*
        * Remove collections
        */
        // $dbh->dropCollections();
    
        /*
        * Initialize registry
        */
        $registry->set('_id', Kernel::REGISTRY_ROOT);
        $registry->set('actions', array (
            'CreateAction' => array (
                'namespace' => '\\Metayogi\\Action\\',
                'label' => 'Add',
                'verb' => 'add',
            ),
            'DeleteAction' => array (
                'namespace' => '\\Metayogi\\Action\\',
                'label' => 'Delete',
                'verb' => 'delete',
                'params' => array (
                    'id' => '*',
                ),
            ),
            'EditAction' => array (
                'namespace' => '\\Metayogi\\Action\\',
                'label' => 'Update',
                'verb' => 'update',
                'params' => array (
                    'id' => '*',
                ),
            ),
            'ListAction' => array (
                'namespace' => '\\Metayogi\\Action\\',
                'label' => 'Show',
                'verb' => '',
                'params' => array (
                    'pagesize' => '10',
                    'pagenum' => '0',
                ),
            ),
            'LoadAction' => array (
                'namespace' => '\\Metayogi\\Action\\',
                'label' => 'Display',
                'verb' => 'display',
                'params' => array (
                    'id' => '*',
                ),
            ),
        ));
        $registry->set('cache', array (
            'my:layouts' => array (
                'theme' => 'r',
                'regions' => 'r',
            ),
            'my:regions' => array (
                'blocks' => 'o',
            ),
            'my:routes' => array (
                'layout' => 'o',
                'view' => 'o',
                'model' => 'o',
                'controller' => 'r',
            ),
        ));
        $registry->set('components', array (
        ));
        $registry->set('displays', array (
        ));
        $registry->set('decorators', array (
        ));
        $registry->set('gadgets', array (
        ));
        $registry->set('widgets', array (
        ));
        $dbh->insert(Kernel::REGISTRY_COLLECTION, $registry->getStore());
        
        /*
        * Find components
        */
        
        /*
        * Install core components
        */
        
    }
}