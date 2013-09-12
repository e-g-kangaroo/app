<?php

namespace Post;

abstract class Model extends \Orm\Model
{
	public static function form_map()
	{
		\Log::info(json_encode(static::properties()));
		return static::properties();
	}
}