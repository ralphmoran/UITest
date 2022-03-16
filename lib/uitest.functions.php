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
	 * Class, trait, and file autoloader.
	 * 
	 * Version: PHP 5 >= 5.1.0, PHP 7, PHP 8
	 *
	 * @param string $file
	 * @return void
	 */
	function file_loader( $file ) : void
	{
		// Path + filename + extension
		$file_stream = stream_resolve_include_path( $file );

		if( $file_stream === false ) {

			// Class name
			$file_stream = stream_resolve_include_path( dirname(__FILE__) . '/classes/' . $file . '.php' );

			if( $file_stream === false ) {

				// Trait name
				$file_stream = stream_resolve_include_path( dirname(__FILE__) . '/traits/' . $file . '.php' );

				if( $file_stream === false )
					return;

			}

		}

		uiloader($file_stream);

	}

	// Registers the autoloader function.
	spl_autoload_register('file_loader');

}

if( ! function_exists("uiloader") )
{
	/**
	 * Loads a file if exists.
	 *
	 * @param string $file
	 * @throws Exception When $file does not exist.
	 * @return void
	 */
	function uiloader( $file ) : void
	{
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
}