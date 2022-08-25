<?php
namespace RafaelMoran\UITest;

use RafaelMoran\UITest\UITestCase;

trait ObjectAssertions
{
	/**
	 * Asserts if two objects are identical if and only if both of them reference 
	 * the same instance of a class.
	 * 
	 * @param object $obj1
	 * @param object $obj2
	 * @return UITestCase
	 */
	protected function assertObjectEqualsByReference( $obj1, $obj2 ) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
											get_defined_vars(), 
											( $obj1 === $obj2 )
										);
	}
	
	/**
	 * Asserts if two objects are instances of the same class and have the same 
	 * properties and values.
	 *
	 * @param object $obj1
	 * @param object $obj2
	 * @return UITestCase
	 */
	protected function assertObjectEqualsByValues( $obj1, $obj2 ) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
											get_defined_vars(), 
											( $obj1 == $obj2 )
										);
	}

}