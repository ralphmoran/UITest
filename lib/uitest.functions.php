<?php

if (! function_exists('env') )
{
	/**
	 * Returns the value of the environment variable.
	 *
	 * @param string $env_var
	 * @return mixed
	 */
	function env( $env_var ) 
	{
		if( isset( $_ENV[$env_var] ) || array_key_exists( $env_var, $_ENV ) )
			return trim($_ENV[$env_var]);
	}
}

if( ! function_exists('load_env') )
{
	/**
	 * Loads the entire environment for the application.
	 *
	 * @return void
	 */
	function load_env() : void
	{
		try{
			if( file_exists('./.env') ){
				foreach( file('./.env') as $env_var ) {
					list($env_var_name, $value) = explode('=', $env_var);
					$_ENV[$env_var_name] = $value;
				}
				return;
			}

			throw new Exception('File: ".env" does not exist.');

		} catch (Exception $e){
			echo $e->getMessage() . "\n";
		}
	}
}

if( ! function_exists("file_loader") )
{
	/**
	 * Class, trait, tests, and file autoloader.
	 *
	 * @param string $file
	 * @throws Exception When $file does not exist.
	 * @return void
	 */
	function file_loader( $file ) : void
	{
		try {
			if( ! isFile( $file ) )
				throw new Exception('File or Class: "' . $file . '" does not exist.');

			uiloader($file);

		} catch (Exception $e){
			echo App\UITesting\Lib\Classes\UIFormatter::setColor(" ERROR ", "bgred", true) . " " . $e->getMessage() . "\n";
		}
	}

	spl_autoload_register('file_loader');
}

if( ! function_exists("isFile") )
{
	/**
	 * Validates if $file exists.
	 *
	 * @param string &$file
	 * @return mixed
	 */
	function isFile( &$file )
	{
		$elements = ['classes', 'traits', 'tests'];

		if( is_file($file) )
			return $file;

		$basedirname = dirname(__FILE__);
		$file        = basename(str_replace('\\', '/', $file));

		foreach($elements as $element){

			$file_tmp = $basedirname . '/'. $element .'/' . $file . '.php';

			if( $element == 'tests' )
				$file_tmp = str_replace('lib/', '', $file_tmp);

			if( is_file($file_tmp) )
				return $file = $file_tmp;
		}

		return false;
	}
}

if( ! function_exists("uiloader") )
{
	/**
	 * Loads a file.
	 *
	 * @param string $file
	 * @return void
	 */
	function uiloader( $file ) : void
	{
		# Avoid object injection exploits
		call_user_func(function () use ( $file ) {
				ob_start();
				@require_once $file;
				ob_end_clean();
			}
		);
	}
}