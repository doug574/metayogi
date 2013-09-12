<?php

/**
* This file is part of Metayogi.
*
* This source file is subject to the MIT license that is bundled
* with this source code in the file LICENSE.
*/

namespace Metayogi\Foundation;

use Metayogi\Foundation\Application;
use Metayogi\Foundation\FlattenedArray;
 
/**
 * Registry is a configuration service
 *
 * @package Metayogi;
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class Registry extends FlattenedArray
{
    /**
    * Database service
    * @var Metayogi\Database\DatabaseInterface
    */
    protected $dbh;
    
    /**
     * Loads registry from database
     *
     * @param Metayogi\Foundation\Application $app
     * @access public
     * @return void
     */
    public function __construct(Application $app)
    {
        try {
            $this->dbh = $app['dbh'];
            $this->store = $this->dbh->load(Kernel::REGISTRY_COLLECTION, Kernel::REGISTRY_ROOT);
        } catch (\Exception $e) {
            $this->store = array();
            Install::install($this->dbh, $this);
        }
    }
        
    /**
     * Reloads the registry from database
     *
     * @access public
     * @return void
     */
    public function reload()
    {
        $this->store = $this->dbh->load(Kernel::REGISTRY_COLLECTION, Kernel::REGISTRY_ROOT);
    }
    
    /**
     * Saves the registry to database
     *
     * @access public
     * @return void
     */
    public function save()
    {
        $this->dbh->update(Kernel::REGISTRY_COLLECTION, $this->store);
    }
}
