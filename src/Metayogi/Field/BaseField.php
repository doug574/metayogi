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
    /** description */
    protected $value;
    protected $label;

    protected $dbh;
    protected $router;
    protected $registry;
    
    /**
    * Base constructor
    *
    * @access public
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
     * Description
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

    public function getLabel()
    {
        return $this->label;
    }
    
    /**
    *
    */
    public function render()
    {
        return $this->value;
    }
}
