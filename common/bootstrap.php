<?php

if ( ! class_exists('Autoloader') )
{
	require COREPATH.'classes'.DIRECTORY_SEPARATOR.'autoloader.php';
	class_alias('Fuel\\Core\\Autoloader', 'Autoloader');
}

if ( ! in_array(COREPATH.'bootstrap.php', get_included_files()))
{
	require COREPATH.'bootstrap.php';
}
