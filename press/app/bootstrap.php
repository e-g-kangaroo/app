<?php

require COMMONPATH.'bootstrap.php';

Autoloader::add_classes(array());

Autoloader::register();

Fuel::$env = (isset($_SERVER['FUEL_ENV']) ? $_SERVER['FUEL_ENV'] : Fuel::DEVELOPMENT);
Fuel::init('config.php');

Finder::instance()->add_path(COMMONPATH, 0);