<?php
namespace App\UITesting\Lib\Traits;

use App\UITesting\Lib\Classes\UITestCase;
trait ClassAssertions
{
	/**
	 * Asserts if $lcass has a static $property.
	 *
	 * @param string $class: If $class has a namespace, it's required to add it.
	 * @param string $property
	 * @return UITestCase
	 */
	protected function assertClassHasStaticAttribute(string $class, string $property) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
											get_defined_vars(), 
											(new \ReflectionProperty($class, $property))->isStatic()
										);
	}

	/**
	 * Asserts if $lcass has a $property.
	 *
	 * @param string $class: If $class has a namespace, it's required to add it.
	 * @param string $property
	 * @return UITestCase
	 */
	protected function assertClassHasAttribute(string $class, string $property) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
											get_defined_vars(), 
											property_exists( $class, $property )
										);
	}

	/**
	 * Asserts if $lcass has a static $method.
	 *
	 * @param string $class: If $class has a namespace, it's required to add it.
	 * @param string $method
	 * @return UITestCase
	 */
	protected function assertClassHasStaticMethod(string $class, string $method) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
											get_defined_vars(), 
											(new \ReflectionMethod($class, $method))->isStatic()
										);
	}

	/**
	 * Asserts if $lcass has $method.
	 *
	 * @param string $class: If $class has a namespace, it's required to add it.
	 * @param string $method
	 * @return UITestCase
	 */
	protected function assertClassHasMethod(string $class, string $method) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
											get_defined_vars(), 
											method_exists( $class, $method )
										);
	}

}