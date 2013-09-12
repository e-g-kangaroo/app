<?php

namespace Skyroof;

class Option
{
	public static function _init()
	{
		\Config::load('skyroof', true);
	}

	public static function get($name, $default = null)
	{
		$result = \DB::select('name', 'value')
			->from(\Config::get('skyroof.options.db.table'))
			->where('name', '=', $name)
			->limit(1)
			->execute();

		return empty($result) ? $default : $result->get('value') ;
	}
}