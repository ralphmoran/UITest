<?php

trait ArrayAssertions
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
	protected function assertArrayHasKey(string $key, array $array) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										( isset($array[$key]) || array_key_exists($key, $array) )
									);
	}
	
	/**
	 * Asserts if a value exists in $array.
	 * 
	 * If value is a string, the comparison is done in a case-sensitive manner.
	 *
	 * @param string $key
	 * @param mixed $array
	 * @return UITestCase
	 */
	protected function assertArrayHasValue($value, array $array, bool $strict) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										( in_array( $value, $array, $strict ) )
									);
	}

	/**
	 * Asserts if $array has same $count of elements.
	 *
	 * @param array $array
	 * @param integer $count
	 * @return UITestCase
	 */
	public function assertCount( array $array, int $count ) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										( is_array($array) ? count($array) == $count : false )
									);
	}

	/**
	 * Asserts if $array is array type.
	 *
	 * @param [type] $array
	 * @return UITestCase
	 */
	public function assertIsArray( $array ) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										is_array( $array )
									);
	}
}