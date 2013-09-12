<?php

return array(
	'profiling' => true,
	'security' => array(
		'uri_filter'       => array('htmlentities'),
		'output_filter'  => array('Security::htmlentities'),
		'whitelisted_classes' => array(
			'Fuel\\Core\\Response',
			'Fuel\\Core\\View',
			'Fuel\\Core\\ViewModel',
			'Closure',
		),
	),
	'package_paths' => array(
		PKGPATH
	),
	'always_load' => array(
		'packages' => array(
			'orm',
			'skyroof',
			'post'
		),
		'config' => array(
			'post'
		)
	),
);
