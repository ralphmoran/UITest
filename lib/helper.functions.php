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