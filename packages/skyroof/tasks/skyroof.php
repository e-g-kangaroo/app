<?php

namespace Fuel\Tasks;

class Skyroof
{
	public static $create_folders = array();
	public static $create_files = array();

	public function generate()
	{
		$args = func_get_args();
		$target = array_shift($args);

		if ( method_exists($this, 'generate_'.$target) )
		{
			call_user_func_array(array($this, 'generate_'.$target), $args);
		}
	}

	public function generate_post()
	{
		$args = func_get_args();
		\Cli::write(json_encode($args));

		$type = array_shift($args);
		$type_h = \Inflector::humanize($type);

		$fields = array(
			'title' => array('type' => 'varchar', 'constraint' => 120, 'form' => 'text', 'position' => 'core'),
			'content' => array('type' => 'text', 'form' => 'content', 'position' => 'core'),
			'published_at' => array('type' => 'int', 'constraint' => 11, 'form' => 'datetime', 'position' => 'side'),
			'status' => array('type' => 'enum', 'constraint' => array('published', 'draft'), 'form' => 'enum', 'position' => 'side', 'enum' => array('published', 'draft'))
		);

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

class Model_{$type_h} extends Model
{
	protected static \$_properties = array(
{$properties_output}
	);
}
POST;

		static::create(PKGPATH.'post/classes/model/'.strtolower($type).'.php', $ouput_post);

		static::build();

		\Config::load('post', true);
		\Config::set('post.types', \Arr::merge(array($type), \Config::get('post.types')));
		\Config::save('post', 'post');
	}

	public static function create($filepath, $contents, $type = 'file')
	{
		$directory = dirname($filepath);
		is_dir($directory) or static::$create_folders[] = $directory;

		// Check if a file exists then work out how to react
		if (file_exists($filepath))
		{
			// Don't override a file
			if (\Cli::option('s', \Cli::option('skip')) === true)
			{
				// Don't bother trying to make this, carry on camping
				return;
			}

			// If we aren't skipping it, tell em to use -f
			if (\Cli::option('f', \Cli::option('force')) === null)
			{
				throw new Exception($filepath .' already exists, use -f or --force to override.');
				exit;
			}
		}

		static::$create_files[] = array(
			'path' => $filepath,
			'contents' => $contents,
			'type' => $type
		);
	}

	public static function build()
	{
		foreach (static::$create_folders as $folder)
		{
			is_dir($folder) or mkdir($folder, 0755, TRUE);
		}

		foreach (static::$create_files as $file)
		{
			\Cli::write("\tCreating {$file['type']}: {$file['path']}", 'green');

			if ( ! $handle = @fopen($file['path'], 'w+'))
			{
				throw new Exception('Cannot open file: '. $file['path']);
			}

			$result = @fwrite($handle, $file['contents']);

			// Write $somecontent to our opened file.
			if ($result === false)
			{
				throw new Exception('Cannot write to file: '. $file['path']);
			}

			@fclose($handle);

			@chmod($file['path'], 0666);
		}

		return $result;
	}
}