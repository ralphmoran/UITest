<?php

trait MiscAssertions
{
    /**
	 * Asserts if $var1 and $var2 are the same in value, if $strict is set, 
	 * this function will assert if the 2 variables are the same type too.
	 *
	 * @param mixed $var1
	 * @param mixed $var2
	 * @param boolean $strict
	 * @return UITestCase
	 */
	protected function assertSame($var1, $var2, bool $strict = false) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										( ($strict) ? ($var1 === $var2) : ($var1 == $var2) )
									);
	}

    /**
	 * Asserts if $var is empty.
	 * 
	 * Any variable that contains "", 0, 0.0, "0", false, [], or NULL 
	 * are considered empty.
	 * 
	 * "null" returns false because it's validated as a string.
	 *
	 * @param mixed $var
	 * @return UITestCase
	 */
	protected function assertEmpty( $var ) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										( empty($var) )
									);
	}

	/**
	 * Asserts if $var is NOT empty.
	 * 
	 * Any variable that contains "", 0, 0.0, "0", false, [], or NULL 
	 * are considered empty.
	 * 
	 * "null" returns true because it's validated as a string.
	 *
	 * @param mixed $var
	 * @return UITestCase
	 */
	protected function assertNotEmpty( $var ) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										( ! empty($var) )
									);
	}
}