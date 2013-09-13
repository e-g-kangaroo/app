<?php

namespace Skyroof\Command;

abstract class Generate
{
	public static $create_folders = array();
	public static $create_files = array();

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