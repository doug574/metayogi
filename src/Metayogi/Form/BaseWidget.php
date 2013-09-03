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
 * @abstract
 */
abstract class BaseWidget
{
    /**
    * Database service
    * @var Metayogi\Database\DatabaseInterface
    */
    protected $dbh;

    /**
    * Router service
    * @var Metayogi\Routing\Router
    */
    protected $router;

    /**
    * Registry service
    * @var Metayogi\Foundation\Registry
    */
    protected $registry;

    /**
    * Viewer service
    * @var Metayogi\Viewer\ViewerInterface
    */
    protected $viewer;

    /**
    * Data for display
    * @var array
    */
    protected $data;

    /**
    * List of accepted attributes
    * var @array
    */
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
    * Makes global services available
    *
    * @access public
    * @param Metayogi\Database\DatabaseInterface               $dbh
    * @param Metayogi\Routing\Router                           $router
    * @param Metayogi\Foundation\Registry                      $registry
    * @param Metayogi\Viewer\ViewerInterface                   $viewer
    * @param array                                             $data
    * @return void
    */
    public function __construct(
        DatabaseInterface $dbh,
        Router $router,
        Registry $registry,
        ViewerInterface $viewer,
        $data
    ) {
        $this->dbh = $dbh;
        $this->router = $router;
        $this->registry = $registry;
        $this->viewer = $viewer;
        $this->data = $data;
    }

    /**
    * Sets the properties common to our widgets
    *
    * @access public
    * @param array  $properties
    * @return void
    */
    public function build($properties)
    {
        $this->label = "";
        $this->classes = array();
        $this->attributes = array();

        $this->attributes['id'] = 'id' . uniqid();  /* xhtml ids cannot start with numeric */
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
    * Magic method to return value of any class property
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

    /**
    * Magic method to set any class property
    *
    * @access public
    * @param string $key   Property name
    * @param mixed  $value Property value
    * @return mixed
    */
    public function __set($key, $value)
    {
        if (in_array($key, BaseWidget::$allowed)) {
            $this->attributes[$key] = $value;
        } else {
            $this->$key = $value;
        }
    }
}
