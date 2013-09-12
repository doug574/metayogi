<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Field;

use Metayogi\Database\DatabaseInterface;
use Metayogi\Routing\Router;
use Metayogi\Foundation\Registry;

/**
 * Defines the base Field class
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
abstract class BaseField
{
    /**
    * Field value
    * @var mixed
    */
    protected $value;
    
    /**
    * Field label
    * @var string
    */
    protected $label;

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
    * Makes global services available  
    *
    * @access public
    * @param Metayogi\Database\DatabaseInterface               $dbh
    * @param Metayogi\Routing\Router                           $router
    * @param Metayogi\Foundation\Registry                      $registry
    * @return void
    */
    public function __construct(DatabaseInterface $dbh, Router $router, Registry $registry)
    {
        $this->value = '&nbsp;';
        $this->dbh = $dbh;
        $this->router = $router;
        $this->registry = $registry;
    }

    /**
     * Sets field properties
     *
     * @param array $properties Description
     * @param array $doc        Desc
     *
     * @return void
     * @access public
     */
    public function build($properties, $doc)
    {
        $name = $properties['name'];
        if (isset($doc[$name])) {
            $this->value = $doc[$name];
        }
        if (isset($properties['label'])) {
            $this->label = $properties['label'];
        }
    }

    public function isDisplayed()
    {
        return true;
    }
    
    /**
    * Get field label
    *
    * @access public
    * @return string
    */
    public function getLabel()
    {
        return $this->label;
    }
    
    /**
    * Gets field value as string
    *
    * @access public
    * @return string
    */
    public function render()
    {
        return $this->value;
    }
}
