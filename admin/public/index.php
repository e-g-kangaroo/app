<?php

error_reporting(-1);
ini_set('display_errors', 1);

define('DOCROOT', __DIR__.DIRECTORY_SEPARATOR);
define('APPPATH', realpath(__DIR__.'/../app/').DIRECTORY_SEPARATOR);
define('ADMINPATH', APPPATH);
define('PRESSPATH', realpath(__DIR__.'/../../press/app/').DIRECTORY_SEPARATOR);
define('PKGPATH', realpath(__DIR__.'/../../packages/').DIRECTORY_SEPARATOR);
define('COREPATH', realpath(__DIR__.'/../../core/').DIRECTORY_SEPARATOR);

defined('FUEL_START_TIME') or define('FUEL_START_TIME', microtime(true));
defined('FUEL_START_MEM') or define('FUEL_START_MEM', memory_get_usage());

require APPPATH.'bootstrap.php';

try
{
	$response = Request::forge()->execute()->response();
}
catch (HttpNotFoundException $e)
{
	$route = array_key_exists('_404_', Router::$routes) ? Router::$routes['_404_']->translation : Config::get('routes._404_');

	if($route instanceof Closure)
	{
		$response = $route();

		if( ! $response instanceof Response)
		{
			$response = Response::forge($response);
		}
	}
	elseif ($route)
	{
		$response = Request::forge($route, false)->execute()->response();
	}
	else
	{
		throw $e;
	}
}

$bm = Profiler::app_total();
$response->body(
	str_replace(
		array('{exec_time}', '{mem_usage}'),
		array(round($bm[0], 4), round($bm[1] / pow(1024, 2), 3)),
		$response->body()
	)
);

$response->send(true);
