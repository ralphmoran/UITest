<?php
namespace App\UITesting\Lib\Traits;

use App\UITesting\Lib\Classes\UITestCase;
trait ObjectAssertions
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
	protected function assertObjectEquals() : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
											get_defined_vars(), 
											is_dir($dir)
										);
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
	protected function assertObjectHasAttribute() : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
											get_defined_vars(), 
											is_dir($dir)
										);
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
	protected function assertObjectHasStaticAttribute() : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
											get_defined_vars(), 
											is_dir($dir)
										);
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
	protected function assertObjectHasMethod() : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
											get_defined_vars(), 
											is_dir($dir)
										);
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
	protected function assertObjectHasStaticMethod() : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
											get_defined_vars(), 
											is_dir($dir)
										);
	}
}