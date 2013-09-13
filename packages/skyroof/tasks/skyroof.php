<?php

namespace Fuel\Tasks;

class Skyroof
{
	public function generate()
	{
		$args = func_get_args();
		$target = array_shift($args);

		$generate_class = '\\Skyroof\\Command\\Generate_'.ucfirst($target);

		if ( class_exists($generate_class) )
		{
			$generate_class::generate($args);
		}
		else
		{
			\Cli::write('Comand not found.', 'red');
		}
	}
}