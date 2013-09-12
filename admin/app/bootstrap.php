<?php

require COREPATH.'classes'.DIRECTORY_SEPARATOR.'autoloader.php';
class_alias('Fuel\\Core\\Autoloader', 'Autoloader');

require COREPATH.'bootstrap.php';
require ADMINPATH.'base.php';

Autoloader::add_classes(array(
	'Html' => ADMINPATH.'classes/html.php',
));

Autoloader::register();

Fuel::$env = (isset($_SERVER['FUEL_ENV']) ? $_SERVER['FUEL_ENV'] : Fuel::DEVELOPMENT);
Fuel::init('config.php');
