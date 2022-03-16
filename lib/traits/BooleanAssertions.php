<?php

trait BooleanAssertions
{
	/**
	 * Asserts if $value is strictly false.
	 *
	 * @param bool $value
	 * @return UITestCase
	 */
	public function assertFalse( $value ) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										( $value === false )
									);
	}

	/**
	 * Asserts if $value is strictly true.
	 *
	 * @param bool $value
	 * @return UITestCase
	 */
	public function assertTrue( $value ) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										( $value === true )
									);
	}

	/**
	 * Asserts if $value is boolean type.
	 *
	 * @param mixed $value
	 * @return UITestCase
	 */
	public function assertIsBool( $value ) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										is_bool($value)
									);
	}
}