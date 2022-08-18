<?php
namespace RafaelMoran\UITest\Traits;

use RafaelMoran\UITest\UITestCase;

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

	/**
	 * Asserts if $equal is equal to $value.
	 *
	 * @param mixed $equal
	 * @param mixed $value
	 * @return UITestCase
	 */
	public function assertEquals( $equal, $value ) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										( $equal == $value )
									);
	}

	/**
	 * Asserts if $less is less than $value.
	 *
	 * @param mixed $less
	 * @param mixed $value
	 * @return UITestCase
	 */
	public function assertLessThan( $less,  $value ) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										( $less < $value )
									);
	}

	/**
	 * Asserts if $lte is less than or equals to $value.
	 *
	 * @param mixed $lte
	 * @param mixed $value
	 * @return UITestCase
	 */
	public function assertLessThanOrEqual( $lte, $value ) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										( $lte <= $value )
									);
	}

	/**
	 * Asserts if $greater is greater than value.
	 *
	 * @param [type] $greater
	 * @param [type] $value
	 * @return UITestCase
	 */
	public function assertGreaterThan( $greater, $value ) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										( $greater > $value )
									);
	}

	/**
	 * Asserts if $greater is greater than or equals to $value.
	 *
	 * @param [type] $greater
	 * @param [type] $value
	 * @return UITestCase
	 */
	public function assertGreaterThanOrEqual( $greater, $value ) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										( $greater >= $value )
									);
	}

	/**
	 * Asserts if $null is NULL type.
	 *
	 * @param mixed $null
	 * @return UITestCase
	 */
	public function assertNull( $null ) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										is_null( $null )
									);
	}

	/**
	 * Asserts if $callable is callable type.
	 *
	 * @param string $callable
	 * @return UITestCase
	 */
	public function assertIsCallable( string $callable ) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										is_callable( $callable, true )
									);
	}
	
	/**
	 * Asserts if $scaller is scalar type.
	 * 
	 * Note that this assertion validates  int, float, string or bool as scalar values.
	 *
	 * @param mixed $scalar
	 * @return UITestCase
	 */
	public function assertIsScalar( $scalar ) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										is_scalar( $scalar )
									);
	}

	/**
	 * Asserts if $object is object type.
	 *
	 * @param mixed $object
	 * @return UITestCase
	 */
	public function assertIsObject( $object ) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										is_object( $object )
									);
	}

	/**
	 * Asserts if $resource is resource type.
	 *
	 * @param resource $resource
	 * @return UITestCase
	 */
	public function assertIsResource( $resource ) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										is_resource( $resource )
									);
	}
	
	/**
	 * Asserts if $infinite is infinite.
	 * 
	 * Note that an infinite value depend on the platform.
	 *
	 * @param float $infinite
	 * @return UITestCase
	 */
	public function assertIsInfinite( $infinite ) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										is_infinite( $infinite )
									);
	}

}