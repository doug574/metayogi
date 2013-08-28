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
use Metayogi\Foundation\Registry;
 
/**
 * Class for matching URLs to a Route object
 *
 * @package Metayoyi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class Router implements RouterInterface
{
    protected $dbh;
#    protected $errorHandler;
    protected $registry;
    protected $route;

    public function __construct(DatabaseInterface $dbh, Registry $registry)
    {
        $this->dbh = $dbh;
        $this->registry = $registry;
#        $this->errorHandler = $app['exception_handler'];
    }
    
	/**
	 * Match the given request to a route object.
	 *
	 * @param  \Symfony\Component\HttpFoundation\Request  $request
	 * @return \Metayogi\Routing\Route
	 */
	public function findRoute(Request $request)
	{
#        try {
            $path = $request->getPathInfo();
            if (substr($path, 0 ,1) == '/') {
                $path = substr($path, 1);
            }
            $route = $this->dbh->load(Kernel::ROUTES_COLLECTION, array('alias' => $path), $this->registry->get('cache'));
#        } catch(DatabaseLoadException $e) {
#            $this->errorHandler->handleException($e);
#        }

        if (PHP_SAPI == 'cli') {
            $route['viewer'] = '\\Metayogi\\Viewer\\CliViewer';
        } else {
            $route['viewer'] = '\\Metayogi\\Viewer\\' . ucfirst($route['output']) . 'Viewer';
        }
        
        /* Set route params */
        /* precedence: registry, route, GET */
        $action = $route['action'];
        $actions = $this->registry->get('actions');
        if (! empty($actions[$action]['params'])) {
            foreach ($actions[$action]['params'] as $param => $val) {
                if (empty($route['params'][$param])) {
                    $route['params'][$param] = $val;
                }
#                if (! empty($request->query->get($param))) {
#                    $route['params'][$param] = $request->query->get($param);
#                }
#                if ($param == 'id') {
#                    $route['instanceID'] = $route['params']['id'];
#                }
            }
        }
if ($route['params']['id']) {
$route['instanceID'] = $route['params']['id'];
}
if ($request->query->get('id')) {
$route['instanceID'] = $request->query->get('id');
}

        $this->route = $route;
    }

    public function getRoute($key = '')
    {
        if ($key == '') {
            return $this->route;
        }
    
        $pieces = explode(".", $key);
        if (count($pieces) == 1) {
            return $this->route[$key];
        } else if (count($pieces) == 2) {
            list($a, $b) = explode(".", $key);
            return $this->route[$a][$b];
        } else if (count($pieces) == 3) {
            list($a, $b, $c) = explode(".", $key);
            return $this->route[$a][$b][$c];
        } else if (count($pieces) == 4) {
            list($a, $b, $c, $d) = explode(".", $key);
            return $this->route[$a][$b][$c][$d];
        } else {
            throw new \Exception('Broken');
        }
    }
    
    public function setRoute($key, $data)
    {
        if ($key == '') {
            $this->route = $data;
            return;
        }
    
        $pieces = explode('.', $key);
        if (count($pieces) == 1) {
            $this->route[$key] = $data;
        } else if (count($pieces) == 2) {
            list($a, $b) = explode(".", $key);
            $this->route[$a][$b] = $data;
        } else if (count($pieces) == 3) {
            list($a, $b, $c) = explode(".", $key);
            $this->route[$a][$b][$c] = $data;
        } else if (count($pieces) == 4) {
            list($a, $b, $c, $d) = explode(".", $key);
            $this->route[$a][$b][$c][$d] = $data;
        } else {
            throw new \Exception('Broken');
        }
    }

}