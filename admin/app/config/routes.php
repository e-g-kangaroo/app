<?php

return array(
	'_root_' => 'system/dashboard',
	'_404_' => 'system/404',

	'post/:type/edit/:id' => 'post/edit/$2',
	'post/:type' => 'post/index/$1',
);
