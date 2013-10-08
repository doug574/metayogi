<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Routing;
 
use Metayogi\Foundation\Kernel;
use Symfony\Component\HttpFoundation\Request;
use Metayogi\Database\DatabaseInterface;
use Metayogi\Database\DatabaseLoadException;
use Metayogi\Foundation\Registry;
use Metayogi\Foundation\FlattenedArray;
 
/**
 * Class for matching URLs to a Route object
 *
 * @package Metayoyi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class Router extends FlattenedArray implements RouterInterface
{
    /**
    * Database service
    * @var Metayogi\Database\DatabaseInterface
    */
    protected $dbh;

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
    * @param Metayogi\Foundation\Registry                      $registry
    * @return void
    */
    public function __construct(DatabaseInterface $dbh, Registry $registry)
    {
        parent::__construct();
        $this->dbh = $dbh;
        $this->registry = $registry;
        $this->route = new FlattenedArray(array());
    }
    
    /**
    * Match the given request to a route object.
    *
    * @access public
    * @param  \Symfony\Component\HttpFoundation\Request  $request
    * @return \Metayogi\Routing\Route
    */
    public function findRoute(Request $request)
    {
        try {
            $path = $request->getPathInfo();
            if (substr($path, 0, 1) == '/') {
                $path = substr($path, 1);
            }
            $route = $this->dbh->load(Kernel::ROUTE_COLLECTION, array('alias' => $path), $this->registry->get('cache'));
        } catch (DatabaseException $e) {
            throw new RouteNotFoundException('not found', 404, $e);
        }
        
        $this->store = $route;
    }
    
    /**
    * Sets route viewer, parameters, and instance
    *
    * @access public
    * @param  \Symfony\Component\HttpFoundation\Request  $request
    * @return void
    */
    public function build(Request $request)
    {
        /* Check if command line */
        if (PHP_SAPI == 'cli') {
            $this->store['viewer'] = '\\Metayogi\\Viewer\\CliViewer';
        } else {
            $this->store['viewer'] = '\\Metayogi\\Viewer\\' . ucfirst($this->store['output']) . 'Viewer';
        }
       
        /* Set route params */
        /* precedence: registry, route, GET */
        $action = $this->store['action'];
        $actions = $this->registry->get('actions');
        foreach ($actions as $actionName => $properties) {
            if ($action == $properties['namespace'] . $actionName) {
                $action = $actionName;
            }
        }
        if (! empty($actions[$action]['params'])) {
            if (! isset($this->store['params'])) {
                $this->store['params'] = array();
            }
            $params = $actions[$action]['params'];
            foreach ($params as $param => $val) {
                if (isset($this->store['params'][$param])) {
                    $this->store['params'][$param] = $this->store['params'][$param];
                } else {
                    $this->store['params'][$param] = $val;
                }
                if ($request->query->has($param)) {
                    $this->store['params'][$param] = $request->query->get($param);
                }
            }
        }

        if (isset($this->store['params']['id'])) {
            $collection = $this->store['controller']['collection'];
            $cache = $this->registry->get('cache');
            $this->store['instance'] =  $this->dbh->load($collection, $this->store['params']['id'], $cache);
        }
        
    }

    /**
    * Shortcut method to return a route's instance
    *
    * @access public
    * @return array 
    */
    public function getInstance()
    {
        if (empty($this->store['params']['id'])) {
            throw new RouterException('No instanceID');
        }
        if (empty($this->store['instance'])) {
            $collection = $this->store['controller']['collection'];
            $cache = $this->registry->get('cache');
            $this->store['instance'] =  $this->dbh->load($collection, $this->store['params']['id'], $cache);
        }
        
        return $this->store['instance'];
    }
}
