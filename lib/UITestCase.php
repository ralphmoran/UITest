<?php

use phpDocumentor\Reflection\DocBlock\Tags\Var_;

abstract class UITestCase
{
	/** @var string Name of the class or function to be used. */
	protected $element = '';

	/** @var array Assertion statuses. */
	private $assertion_status = array();

	/**
	 * Method run() will perform all assertions from UITestCase instances.
	 *
	 * @return UITestCase
	 */
	public function run() : UITestCase
	{
		if( ! function_exists($this->element) && ! class_exists($this->element) ){
			$this->logAssertionStatus($this->element, 
										array("error" => "$this->element does not exist."), 
										false
									);
			return $this;
		}

		$test_case = get_class(debug_backtrace()[0]['object']);

		$this->assertion_status[ $test_case ] = array(); 

		foreach( get_class_methods($test_case) as $method )
			if( strpos($method, 'test_') === 0 )
				call_user_func( array($this, $method) );

		return $this;
	}

	/**
	 * Logs all assertion statuses.
	 *
	 * @param string $name
	 * @param array $args
	 * @param boolean $status
	 * @return bool
	 */
	private function logAssertionStatus(string $name, array $args, bool $status = true) : bool
	{
		// Tracking back the parent method that called the assertion
		$this->assertion_status[ debug_backtrace()[2]['class'] ][ debug_backtrace()[2]['function'] ][] = get_defined_vars();

		return $status;
	}

	
	###############################################################
	/** Assertions */
	###############################################################

	/**
	 * Asserts if  $var1 and $var2 are the same in value, if $strict is set, 
	 * this function will assert if the 2 variables are the same type too.
	 *
	 * @param mixed $var1
	 * @param mixed $var2
	 * @param boolean $strict
	 * @return boolean
	 */
	protected function assertSame($var1, $var2, $strict = false) : bool
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										( ($strict) ? ($var1 === $var2) : ($var1 == $var2) )
									);
	}
	
	/**
	 * Asserts if $var1 and $var2 have the same length.
	 *
	 * @param mixed $var1
	 * @param mixed $var2
	 * @return boolean
	 */
	protected function assertSameSize($var1, $var2) : bool
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										( strlen($var1) === strlen($var2) )
									);
	}

	/**
	 * Asserts if a key exists in the array.
	 * 
	 * It's important to notice that this method will return true even though
	 * the value of the key is NULL.
	 *
	 * @param string $key
	 * @param array $array
	 * @return boolean
	 */
	protected function assertArrayHasKey(string $key, array $array) : bool
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										( isset($array[$key]) || array_key_exists($key, $array) )
									);
	}

	/**
	 * Asserts length of a variable as string.
	 *
	 * @param string $str
	 * @param int $length
	 * @return boolean
	 */
	protected function assertLength(string $str, int $length) : bool
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										( strlen($str) === $length )
									);
	}

	/**
	 * Returns private property $this->assertion_status array.
	 *
	 * @return array
	 */
	public function getAssertionStatus() : array
	{
		return $this->assertion_status;
	}

	/*

	(*)assertArrayHasKey()
	(*)assertLength()
	assertClassHasAttribute()
	assertClassHasStaticAttribute()
	assertContains()
	assertStringContainsString()
	assertStringContainsStringIgnoringCase()
	assertContainsOnly()
	assertContainsOnlyInstancesOf()
	assertCount()
	assertDirectoryExists()
	assertDirectoryIsReadable()
	assertDirectoryIsWritable()
	assertEmpty()
	assertEquals()
	assertEqualsCanonicalizing()
	assertEqualsIgnoringCase()
	assertEqualsWithDelta()
	assertObjectEquals()
	assertFalse()
	assertFileEquals()
	assertFileExists()
	assertFileIsReadable()
	assertFileIsWritable()
	assertGreaterThan()
	assertGreaterThanOrEqual()
	assertInfinite()
	assertInstanceOf()
	assertIsArray()
	assertIsBool()
	assertIsCallable()
	assertIsFloat()
	assertIsInt()
	assertIsIterable()
	assertIsNumeric()
	assertIsObject()
	assertIsResource()
	assertIsScalar()
	assertIsString()
	assertIsReadable()
	assertIsWritable()
	assertJsonFileEqualsJsonFile()
	assertJsonStringEqualsJsonFile()
	assertJsonStringEqualsJsonString()
	assertLessThan()
	assertLessThanOrEqual()
	assertNan()
	assertNull()
	assertObjectHasAttribute()
	assertMatchesRegularExpression()
	assertStringMatchesFormat()
	assertStringMatchesFormatFile()
	(*)assertSame()
	(*)assertSameSize()
	assertStringEndsWith()
	assertStringEqualsFile()
	assertStringStartsWith()
	assertThat()
	assertTrue()
	assertXmlFileEqualsXmlFile()
	assertXmlStringEqualsXmlFile()
	assertXmlStringEqualsXmlString()
 	
	*/
	
}