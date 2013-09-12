<?php

if ( ! function_exists('require_delegate') )
{
	function require_delegate($filepath, array $default = array())
	{
		if ( file_exists(PRESSPATH.$filepath) )
		{
			return require PRESSPATH.$filepath;
		}
		else
		{
			return $default;
		}
	}
}
