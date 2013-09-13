<?php

namespace Post;

abstract class Model extends \Orm\Model
{
	protected static $_title = 'title';

	protected static $_content = 'content';

	protected static $_publish_conditions = array('where' => array(array('status', '=', 'published')));

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

	public static function find($id = null, array $options = array())
	{
		if ( $id == 'published' )
		{
			$id = 'all';

			$options = \Arr::merge($options, static::$_publish_conditions);
		}

		return parent::find($id, $options);
	}

	public static function find_piblished($id = null, array $options = array())
	{
		$options = \Arr::merge($options, static::$_publish_conditions);

		return parent::find($id, $options);
	}
}