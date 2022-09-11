<?php

if (! function_exists("test_loader"))
{
	/**
	 * Class, trait, tests, and file autoloader.
	 *
	 * @param string $file
	 * @throws Exception When $file does not exist.
	 * @return void
	 */
	function test_loader($file) : void
	{
		try {
			if (! isFile($file)) {
				throw new Exception('File or Class: "' . $file . '" does not exist.');
			}

			uiloader($file);

		} catch (Exception $e) {
			echo RafaelMoran\UITest\UIFormatter::setColor(" ERROR ", "bgred", true) . " " . $e->getMessage() . "\n";
		}
	}

	spl_autoload_register('test_loader');
}

if (! function_exists("isFile"))
{
	/**
	 * Validates if $file exists.
	 *
	 * @param string &$file
	 * @return mixed
	 */
	function isFile(&$file)
	{
		// Checks if $file exists in host app
		$tmp_file = dirname(__FILE__, 5) . '/' . lcfirst(str_replace('\\', '/', $file)) . '.php';

		if (is_file($tmp_file)) {
			return $file = $tmp_file;
		}

		$elements = ['classes', 'traits', 'tests'];

		if (is_file($file)) {
			return $file;
		}

		$basedirname = dirname(__FILE__);
		$file        = basename(str_replace('\\', '/', $file));

		foreach ($elements as $element) {

			$file_tmp = $basedirname . '/'. $element .'/' . $file . '.php';

			if ($element == 'tests') {
				$file_tmp = str_replace('lib/', '', $file_tmp);
			}

			if (is_file($file_tmp)) {
				return $file = $file_tmp;
			}
		}

		return false;
	}
}

if (! function_exists("uiloader"))
{
	/**
	 * Loads a file.
	 *
	 * @param string $file
	 * @return void
	 */
	function uiloader($file) : void
	{
		// Avoid object injection exploits
		call_user_func(function () use ($file) {
				ob_start();
				@require_once $file;
				ob_end_clean();
			}
		);
	}
}
