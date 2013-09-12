<?php

namespace Post;

abstract class Model extends \Orm\Model
{
	public static function form_map()
	{
		\Log::info(json_encode(static::properties()));
		return static::properties();
	}

	public function title()
	{
		return $this->{static::$_title};
	}

	public function content()
	{
		return $this->{static::$_content};
	}
}