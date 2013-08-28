<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Exception;

use Metayogi\Foundation\Application;

/**
 * Handler for exceptions and errors.
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class Handler
{
	/**
	 * Indicates if the application is in debug mode.
	 *
	 * @var bool
	 */
	protected $debug;

    protected $logger;
    protected $mediator;
    
	/**
	 * Create a new error handler instance.
	 *
     * @param bool $debug
	 * @return void
	 */
	public function __construct(Application $app, $debug = false)
    {
        $this->logger = $app['logger'];
        $this->mediator = $app['mediator'];
        $this->debug = $debug;
    }
  
	/**
	 * Register the exception / error handlers for the application.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerErrorHandler();
		$this->registerExceptionHandler();
	}

	/**
	 * Register the PHP error handler.
	 *
	 * @return void
	 */
	protected function registerErrorHandler()
	{
#		set_error_handler(array($this, 'handleError'));
	}

	/**
	 * Register the PHP exception handler.
	 *
	 * @return void
	 */
	protected function registerExceptionHandler()
	{
		set_exception_handler(array($this, 'handleException'));
	}

	/**
	 * Handle a PHP error for the application.
	 *
	 * @param  int     $level
	 * @param  string  $message
	 * @param  string  $file
	 * @param  int     $line
	 * @param  array   $context
	 */
	public function handleError($level, $message, $file, $line, $context)
	{
		if (error_reporting() & $level)
		{
			$e = new \ErrorException($message, $level, 0, $file, $line);

			$this->handleException($e);
		}
	}

	/**
	 * Handle an exception for the application.
	 *
	 * @param  \Exception  $exception
	 * @return void
	 */
	public function handleException($exception)
	{
#        $this->logger->addError($exception->getMessage());
#print "Hello, I'm an error\n"; 
print $exception->getMessage();   
            echo "<pre>";
            echo $exception->getTraceAsString();
            echo "</pre>";

    }
 
	/**
	 * Set the debug level for the handler.
	 *
	 * @param  bool  $debug
	 * @return void
	 */
	public function setDebug($debug)
	{
		$this->debug = $debug;
	}
 
}