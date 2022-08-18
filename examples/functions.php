<?php

if (! function_exists('getRandomStr')) {
	/**
	 * Returns random sting
	 *
	 * @param integer $length
	 * @return string
	 */
	function getRandomStr($length = 25) : string
	{
		$str = '';
		$start = 97; // lowercase

		if ($length <= 25)
			for ($i = 0; $i < $length; $i++)
				$str .= chr(mt_rand($start, $start + mt_rand(0, $length)));
		
		return $str;

	}
}

if (! function_exists('getRandomInt')) {
	/**
	 * Returns a random integer.
	 *
	 * @return integer
	 */
	function getRandomInt() : int
	{
		return mt_rand();
	}
}