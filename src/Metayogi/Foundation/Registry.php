<?php

/**
* This file is part of Metayogi.
*
* This source file is subject to the MIT license that is bundled
* with this source code in the file LICENSE.
*/

namespace Metayogi\Foundation;

use Metayogi\Foundation\Application;
 
/**
 * Object wrapper for registry array
 *
 * @package Metayogi;
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class Registry
{
    protected $store;
    protected $dbh;
    
    public function __construct(Application $app)
    {
        $this->dbh = $app['dbh'];
        $this->store = $this->dbh->load(Kernel::REGISTRY_COLLECTION, Kernel::REGISTRY_ROOT);
    }
        
    public function get($key)
    {
        $pieces = explode(".", $key);
        if (count($pieces) == 1) {
            return $this->store[$key];
        } else if (count($pieces) == 2) {
            list($a, $b) = explode(".", $key);
            return $this->store[$a][$b];
        } else if (count($pieces) == 3) {
            list($a, $b, $c) = explode(".", $key);
            return $this->store[$a][$b][$c];
        } else if (count($pieces) == 4) {
            list($a, $b, $c, $d) = explode(".", $key);
            return $this->store[$a][$b][$c][$d];
        } else {
            throw new \Exception('Broken');
        }
    }
    
    public function set($key, $data)
    {
        $this->store[$key] = $data;
    }
    
}