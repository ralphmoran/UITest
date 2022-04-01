<?php
namespace App\UITesting\Lib\Traits;

use App\UITesting\Lib\Classes\UITestCase;
trait ClassAssertions
{
	/**
	 * Asserts if a key exists in the array.
	 * 
	 * This assertion will return true even though the value of the key is NULL.
	 *
	 * @param string $key
	 * @param array $array
	 * @return UITestCase
	 */
	protected function assertClassHasStaticAttribute(string $key, array $array) : UITestCase
	{
		
	}

	/**
	 * Asserts if a key exists in the array.
	 * 
	 * This assertion will return true even though the value of the key is NULL.
	 *
	 * @param string $key
	 * @param array $array
	 * @return UITestCase
	 */
	protected function assertClassHasAttribute(string $key, array $array) : UITestCase
	{

	}

	/**
	 * Asserts if a key exists in the array.
	 * 
	 * This assertion will return true even though the value of the key is NULL.
	 *
	 * @param string $key
	 * @param array $array
	 * @return UITestCase
	 */
	protected function assertClassHasStaticMethod(string $key, array $array) : UITestCase
	{

	}

	/**
	 * Asserts if a key exists in the array.
	 * 
	 * This assertion will return true even though the value of the key is NULL.
	 *
	 * @param string $key
	 * @param array $array
	 * @return UITestCase
	 */
	protected function assertClassHasMethod(string $key, array $array) : UITestCase
	{

	}

}