<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Foundation;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Metayogi\Routing\RouterInterface;
 
/**
 * Class for generating a response based on a client request
 *
 * @package Metayogi;
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class Controller
{
    protected $mediator;

    protected $router;
    
	/**
	 * Get the response for a given request.
	 *
	 * @param  \Symfony\Component\HttpFoundation\Request  $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function handle(Request $request)
	{
        $this->mediator->dispatch('route.pre');

        $route = $this->router->findRoute($request);
        $this->mediator->dispatch('route.pre');

        $this->mediator->dispatch('request.pre');
        
        $this->mediator->dispatch('request.post');

        $this->mediator->dispatch('response.pre');
    }

    public function setMediator(EventDispatcherInterface $mediator)
    {
        $this->mediator = $mediator;
    }

    public function setRouter(RouterInterface $router)
    {
        $this->router = $router;
    }
}