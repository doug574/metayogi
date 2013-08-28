<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Foundation;

/**
 * desc
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class ObjectWrapper
{
    protected $store;
    
    public function __construct($store = array())
    {
        $this->store = $store;
    }

    public function setStore($store = array())
    {
        $this->store = $store;
    }

    public function getStore()
    {
        return $store;
    }
    
    public function get($key)
    {
        $pieces = explode(".", $key);
        if (count($pieces) == 1) {
            return $this->store[$key];
        } else if (count($pieces) == 2) {
            list($a, $b) = explode(".", $key);
            return $this->store[$a][$b];
        } else {
            throw new \Exception('Broken');
        }
    }
    
    public function set($key, $data)
    {
        $this->store[$key] = $data;
    }

}