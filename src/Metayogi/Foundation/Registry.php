<?php

/**
* This file is part of Metayogi.
*
* This source file is subject to the MIT license that is bundled
* with this source code in the file LICENSE.
*/

namespace Metayogi\Foundation;
 
/**
 * Registry
 *
 * @package Metayogi;
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class Registry
{
    protected $store;
    
    public function __construct($data = array())
    {
        $this->store = $data;
    }
    
    public function setStore($data = array())
    {
        $this->store = $data;
    }
    
    public function getStore()
    {
        return $this->store;
    }
    
    public function get($key)
    {
        return $this->store[$key];
    }
    
    public function set($key, $data)
    {
        $this->store[$key] = $data;
    }
    
}