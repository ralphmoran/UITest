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
			return str_replace(array("\n"), array(""), $_ENV[$env_var]);
	}
}

if( ! function_exists('load_env') )
{
	/**
	 * Loads the entire environment for the application.
	 *
	 * @return void
	 */
	function load_env()
	{
		if( file_exists('./.env') )
			foreach( file('./.env') as $env_var ) {
				list($env_var_name, $value) = explode('=', $env_var);
				$_ENV[$env_var_name] = $value;
			} 
	}
}

if( ! function_exists("file_loader") )
{
	/**
	 * Class and file autoloader.
	 * 
	 * Version: PHP 5 >= 5.1.0, PHP 7, PHP 8
	 *
	 * @param string $file
	 * @throws Exception When $file does not exist.
	 * @return void
	 */
	function file_loader($file) 
	{
		$file = ( strpos($file, ".php") === false ) 
			?  dirname(__FILE__) . '/' . $file . '.php' 
			: $file;

		# Avoid object injection exploits
		call_user_func(function () use ( $file ) {
				ob_start();

				try {
					if( ! file_exists( $file ) ){
						throw new Exception('File: ' . $file . ' does not exist.');
						ob_end_clean();
					}

					@require_once $file;
				} catch (Exception $e){
					echo $e->getMessage() . "\n";
				}

				ob_end_clean();
			}
		);
	}

	# Registers the autoloader function.
	spl_autoload_register('file_loader');

}