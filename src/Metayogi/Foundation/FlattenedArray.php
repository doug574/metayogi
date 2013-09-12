<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Foundation;

/**
 * Makes a multi-dimensional array addressible with single-dimension keys 
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class FlattenedArray
{
    /**
    * Array being flattened
    * @var array
    */
    protected $store;

    /**
    * Init object with store array
    *
    * @access public
    * @param array $store
    * @return void
    */
    public function __construct($store = array())
    {
        $this->store = $store;
    }

    /**
    * Sets the store array
    *
    * @access public
    * @param array $store
    * @return void
    */
    public function setStore($store = array())
    {
        $this->store = $store;
    }

    /**
    * Returns store array
    *
    * @access public
    * @return array
    */
    public function getStore()
    {
        return $this->store;
    }
    
    /**
    * Get data from store array
    *
    * @access public
    * @param string $key
    * @return  mixed
    */
    public function get($key)
    {
        $nested = strpos($key, '.');
        if ($nested === false) {
            return $this->store[$key];
        }
  
        $pieces = explode(".", $key);
        if (count($pieces) == 1) {
            return $this->store[$key];
        } elseif (count($pieces) == 2) {
            list($a, $b) = explode(".", $key);
            return $this->store[$a][$b];
        } elseif (count($pieces) == 3) {
            list($a, $b, $c) = explode(".", $key);
            return $this->store[$a][$b][$c];
        } elseif (count($pieces) == 4) {
            list($a, $b, $c, $d) = explode(".", $key);
            return $this->store[$a][$b][$c][$d];
        } elseif (count($pieces) == 5) {
            list($a, $b, $c, $d, $e) = explode(".", $key);
            return $this->store[$a][$b][$c][$d][$e];
        } else {
            throw new \Exception('Array nested too deep');
        }
    }

    /**
    * Does element exist in store array
    *
    * @access public
    * @param string $key
    * @return boolean
    */
    public function has($key)
    {
        $nested = strpos($key, '.');
        if ($nested === false) {
            return array_key_exists($key, $this->store);
        }
        
        $pieces = explode(".", $key);
        if (count($pieces) == 1) {
            return array_key_exists($key, $this->store);
        } elseif (count($pieces) == 2) {
            list($a, $b) = explode(".", $key);
            return isset($this->store[$a][$b]);
        } elseif (count($pieces) == 3) {
            list($a, $b, $c) = explode(".", $key);
            return isset($this->store[$a][$b][$c]);
        } elseif (count($pieces) == 4) {
            list($a, $b, $c, $d) = explode(".", $key);
            return isset($this->store[$a][$b][$c][$d]);
        } elseif (count($pieces) == 5) {
            list($a, $b, $c, $d, $e) = explode(".", $key);
            return isset($this->store[$a][$b][$c][$d][$e]);
        } else {
            throw new \Exception('Array nested too deep');
        }
        
    }
    
    /**
    * Set data in store array
    *
    * @access public
    * @param string $key
    * @param mixed  $data
    * @return void
    */
    public function set($key, $data)
    {
        $nested = strpos($key, '.');
        if ($nested === false) {
            $this->store[$key] = $data;
            
            return;
        }

        $pieces = explode('.', $key);
        if (count($pieces) == 1) {
            $this->store[$key] = $data;
        } elseif (count($pieces) == 2) {
            list($a, $b) = explode(".", $key);
            $this->store[$a][$b] = $data;
        } elseif (count($pieces) == 3) {
            list($a, $b, $c) = explode(".", $key);
            $this->store[$a][$b][$c] = $data;
        } elseif (count($pieces) == 4) {
            list($a, $b, $c, $d) = explode(".", $key);
            $this->store[$a][$b][$c][$d] = $data;
        } elseif (count($pieces) == 5) {
            list($a, $b, $c, $d, $e) = explode(".", $key);
            $this->store[$a][$b][$c][$d][$e] = $data;
        } else {
            throw new \Exception('Array nested too deep');
        }
    }

    /**
    * Appends data to store array
    *
    * @access public
    * @param string $key
    * @param mixed  $data
    * @return void
    */
    public function push($key, $data)
    {
        $nested = strpos($key, '.');
        if ($nested === false) {
            $this->store[$key][] = $data;
            
            return;
        }

        $pieces = explode('.', $key);
        if (count($pieces) == 1) {
            $this->store[$key][] = $data;
        } elseif (count($pieces) == 2) {
            list($a, $b) = explode(".", $key);
            $this->store[$a][$b][] = $data;
        } elseif (count($pieces) == 3) {
            list($a, $b, $c) = explode(".", $key);
            $this->store[$a][$b][$c][] = $data;
        } elseif (count($pieces) == 4) {
            list($a, $b, $c, $d) = explode(".", $key);
            $this->store[$a][$b][$c][$d][] = $data;
        } elseif (count($pieces) == 5) {
            list($a, $b, $c, $d, $e) = explode(".", $key);
            $this->store[$a][$b][$c][$d][$e][] = $data;
        } else {
            throw new \Exception('Array nested too deep');
        }
    }
}
