<?php
/**
 * Class autoloader.
 * 
 * Version: PHP 5 >= 5.1.0, PHP 7, PHP 8
 *
 * @param [type] $class_name
 * @return void
 */
function autoloader($class_name) 
{
	$file = dirname(__FILE__) . '/' . $class_name . '.php';

	if( file_exists($file) )
		require_once $file;
}

# Registers the autoloader function.
spl_autoload_register('autoloader');