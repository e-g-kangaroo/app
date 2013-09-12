<?php

namespace Post;

abstract class Model extends \Orm\Model
{
	public static function form_map($type = null)
	{
		if ( ! empty($type) )
		{
			$type = (string) $type;
		}

		$properties = static::properties();
		$form_map = array();

		foreach ( $properties as $name => $property )
		{
			if ( isset($property['position']) and ( empty($type) or $type == $property['position'] ) )
			{
				$form_map[$name] = $property;

				if ( ! isset($form_map[$name]['form']) )
				{
					$form_map[$name]['form'] = 'text';
				}
			}
		}

		return $form_map;
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