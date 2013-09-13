<?php

namespace Skyroof\Command;

class Generate_Post extends Generate
{

	public static function generate($args, $build = true)
	{
		\Cli::write(json_encode($args));

		$post_type = array_shift($args);
		$post_type_h = \Inflector::humanize($post_type);

		$fields = array(
			'title' => array('type' => 'varchar', 'constraint' => 120, 'form' => 'text', 'position' => 'core'),
			'content' => array('type' => 'text', 'form' => 'content', 'position' => 'core'),
			'published_at' => array('type' => 'int', 'constraint' => 11, 'form' => 'datetime', 'position' => 'side'),
			'status' => array('type' => 'enum', 'constraint' => array('published', 'draft'), 'form' => 'enum', 'position' => 'side', 'enum' => array('published', 'draft'))
		);

		foreach ( $args as $arg )
		{
			if ( preg_match('/^([a-z]+):(string|int|date|datetime|enum\[[a-z_,\s]\])$/', $arg, $matches) )
			{
				array_shift($matches);
				list($name, $opt) = $matches;

				$type = 'varchar';
				$form = 'text';
				$position = 'left';
				$constraint = 120;

				if ( $opt == 'int' )
				{
					$constraint = 11;
				}

				$fields[$name] = compact('type', 'constraint', 'form', 'position');

				if ( substr($opt, 0, 4) == 'enum' )
				{
					$enum = explode(',', substr($opt, 5, -2));
					array_walk($enum, function (&$val) { trim($val); });

					$fields[$name]['enum'] = $enum;
				}
			}
		}

		$properties_output = '';

		foreach ( $fields as $name => $field )
		{
			$field_opts = '';

			foreach ( $field as $_k => $_v )
			{
				if ( in_array($_k, array('form', 'default', 'position', 'enum')) )
				{
					if ( is_string($_v) )
					{
						$field_opts .= "'{$_k}' => '{$_v}', ";
					}
					else if ( is_int($_v) )
					{
						$field_opts .= "'{$_k}' => {$_v}, ";
					}
					else if ( is_array($_v) )
					{
						$field_opts .= "'{$_k}' => array('" . implode("', '", $_v) . "'), ";
					}
				}
			}

			$properties_output .= "\t\t'{$name}' => array( {$field_opts}),\n";
		}

		$ouput_post = <<<POST
<?php

namespace Post;

class Model_{$post_type_h} extends Model
{
	protected static \$_properties = array(
{$properties_output}
	);
}
POST;

		static::create(PKGPATH.'post/classes/model/'.strtolower($post_type).'.php', $ouput_post);

		\Config::load('post', true);
		\Config::set('post.types', \Arr::merge(array($type), \Config::get('post.types')));

		if ( $build )
		{
			static::build();
			\Config::save('post', 'post');
		}
	}

}