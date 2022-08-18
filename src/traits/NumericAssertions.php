<?php
namespace RafaelMoran\UITest\Traits;

use RafaelMoran\UITest\UITestCase;

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

	/**
	 * Asserts if $int is int type.
	 *
	 * @param mixed $int
	 * @return UITestCase
	 */
	public function assertIsInt( $int ) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										is_int( $int )
									);
	}

	/**
	 * Asserts if $numeric is numeric string type.
	 *
	 * @param mixed $numeric
	 * @return UITestCase
	 */
	public function assertIsNumeric( $numeric ) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										is_numeric( $numeric )
									);
	}

	/**
	 * Asserts if $nan is not number type.
	 *
	 * @param float $nan
	 * @return UITestCase
	 */
	public function assertNan( $nan ) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										is_nan( $nan )
									);
	}
}