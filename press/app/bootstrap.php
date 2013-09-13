<?php

require COREPATH.'classes'.DIRECTORY_SEPARATOR.'autoloader.php';
class_alias('Fuel\\Core\\Autoloader', 'Autoloader');

require COREPATH.'bootstrap.php';

Autoloader::add_classes(array());

Autoloader::register();

Fuel::$env = (isset($_SERVER['FUEL_ENV']) ? $_SERVER['FUEL_ENV'] : Fuel::DEVELOPMENT);
Fuel::init('config.php');

Finder::instance()->add_path(realpath(__DIR__.'/../../common/').DIRECTORY_SEPARATOR, 0);