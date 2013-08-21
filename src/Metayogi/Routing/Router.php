<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Routing;
 
use Metayogi\Database\DatabaseInterface;
use Metayogi\Foundation\Kernel;
use Symfony\Component\HttpFoundation\Request; 
use Metayogi\Database\DatabaseLoadException;
use Metayogi\Exception\Handler;
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
    protected $errorHandler;
    protected $registry;

	/**
	 * Match the given request to a route object.
	 *
	 * @param  \Symfony\Component\HttpFoundation\Request  $request
	 * @return \Metayogi\Routing\Route
	 */
	public function findRoute(Request $request)
	{
        try {
            $path = $request->getPathInfo();
            $route = $this->dbh->load(Kernel::ROUTES_COLLECTION, array('alias' => $path), $this->registry->get('cache'));
        } catch(DatabaseLoadException $e) {
            $this->errorHandler->handleException($e);
        }
        
        return $route;
    }

    public function setDbh(DatabaseInterface $dbh)
    {
        $this->dbh = $dbh;
    }
    
    public function setErrorHandler(Handler $handler)
    {
        $this->errorHandler = $handler;
    }
    
    public function setRegistry(Registry $registry)
    {
        $this->registry = $registry;
    }
}