<?php

class Html extends \Fuel\Core\Html
{
	public static function link_to_type($type)
	{
		return static::anchor('post/'.$type, Inflector::humanize($type));
	}
}