<?php

trait NumericAssertions
{
	/**
	 * Asserts if $value is float type.
	 * 
	 * Scientific notation is treated as float type.
	 * 
	 * E.g.:
	 * 
	 * $this->assertIsFloat(1e7);  // true
	 *
	 * @param mixed $value
	 * @return UITestCase
	 */
	public function assertIsFloat( $value ) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										is_float($value)
									);
	}
}