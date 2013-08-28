<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Form;

use Metayogi\Database\DatabaseInterface;
use Metayogi\Routing\Router;
use Metayogi\Foundation\Registry;
use Metayogi\Viewer\ViewerInterface;

/**
 * Abstract base class for both form elements and form containers.
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
abstract class BaseWidget
{
    protected $dbh;
    protected $router;
    protected $registry;
    protected $viewer;
    protected $data;

    public static $allowed = array('id', 'name', 'method', 'enctype'); 
    
    /**
    * Label for container/element
    * @var string
    */
    protected $label;

    /**
    * CSS classes added to container/element
    * @var array
    */
    protected $classes;

    /**
    * The html attributes of the container/element
    * @var array
    */
    protected $attributes;

    /**
    * Base constructor
    *
    * @access public
    * @return void
    */
    public function __construct(DatabaseInterface $dbh, Router $router, Registry $registry, ViewerInterface $viewer, $data)
    {
        $this->dbh = $dbh;
        $this->router = $router;
        $this->registry = $registry;
        $this->viewer = $viewer;
        $this->data = $data;
	}

    /**
    * desc
    *
    * @param array  $properties Desc
    *
    * @access public
    * @return void
    */
    public function build($properties)
    {
		$this->label = "";
		$this->classes = array();
		$this->attributes = array();
       
        $this->attributes['id'] = 'id' . uniqid();	/* xhtml ids cannot start with numeric */	
		foreach ($properties as $prop => $value) {
            $this->$prop = $value;
		}

    }

   /**
    * Adds attributes common to all elements and containers
    *
    * @access protected
    * @return string
    */
    protected function addAttributes()
    {
        $str = "";
        if (! empty($this->attributes)) {
            foreach ($this->attributes as $key => $val) {
                $str .= " $key='$val' ";
            }
        }

        if (! empty($this->classes)) {
            $str .= " class='" . implode(" ", $this->classes) . "' ";
        }

        return $str;
    }
	
    /**
    * Magic mathod to return value of any class property
    *
    * @param string $key Property name
    *
    * @access public
    * @return mixed
    */
    public function __get($key)
    {

		if (in_array($key, BaseWidget::$allowed)) {
            return $this->attributes[$key];
        } else {
            return $this->$key;
        }

        return null;
    }
	
    public function __set($key, $value)
    {
        if (in_array($key, BaseWidget::$allowed)) {
			$this->attributes[$key] = $value;
		} else {
			$this->$key = $value;
		}
    }

}