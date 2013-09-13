<?php

Autoloader::add_classes(array(
	'Skyroof' => __DIR__.'/classes/skyroof.php',
	'Skyroof\\Command\\Generate' => __DIR__.'/classes/command/generate.php',
	'Skyroof\\Command\\Generate_Post' => __DIR__.'/classes/command/generate/post.php',
	'Skyroof\\Option' => __DIR__.'/classes/option.php',
));