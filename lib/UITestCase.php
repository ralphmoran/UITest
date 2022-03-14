<?php

abstract class UITestCase
{
	/** @var string Name of the class or function to be used. */
	protected $element = '';

	/** @var array Assertion statuses. */
	private $assertion_status = [];

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

		$this->assertion_status[ $test_case ] = []; 

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
	 * @return UITestCase
	 */
	private function logAssertionStatus(string $name, array $args, bool $status = true) : UITestCase
	{
		// Tracking back the parent method that called the assertion
		$this->assertion_status[ debug_backtrace()[2]['class'] ][ debug_backtrace()[2]['function'] ][] = get_defined_vars();

		return $this;
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
	
	###############################################################
	/** Assertions */
	###############################################################

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
	 * Asserts if $var1 and $var2 have the same length.
	 *
	 * @param mixed $var1
	 * @param mixed $var2
	 * @return UITestCase
	 */
	protected function assertSameSize($var1, $var2) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										( strlen($var1) === strlen($var2) )
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
	 * Asserts length of a string variable.
	 *
	 * @param string $str
	 * @param int $length
	 * @return UITestCase
	 */
	protected function assertLength(string $str, int $length) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										( strlen($str) === $length )
									);
	}

	/**
	 * Asserts if $str variable is string type.
	 * 
	 * All values between "" or '' are considered strings.
	 *
	 * @param string $str
	 * @return UITestCase
	 */
	protected function assertIsString(string $str) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										( is_string($str) )
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
	 * Asserts the position of the first occurrence of a substring in a string.
	 *
	 * @param string $haystack
	 * @param string $needle
	 * @return UITestCase
	 */
	public function  assertStringContainsString( string $haystack, string $needle ) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										( strpos($haystack, $needle) === false )
									);
	}

	/**
	 * Asserts the position of the first occurrence of a case-insensitive 
	 * substring in a string.
	 *
	 * @param string $haystack
	 * @param string $needle
	 * @return UITestCase
	 */
	public function assertStringContainsStringIgnoringCase( string $haystack, string $needle ) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										( stripos($haystack, $needle) === false )
									);
	}

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
	 * Asserts if $dir exists.
	 *
	 * @param string $dir
	 * @return UITestCase
	 */
	public function assertDirectoryExists( string $dir ) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										is_dir($dir)
									);
	}

	/**
	 * Asserts if $idr is readable.
	 *
	 * @param string $dir
	 * @return UITestCase
	 */
	public function assertDirectoryIsReadable( string $dir ) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										is_readable($dir)
									);
	}

	/**
	 * Asserts if $idr is writable.
	 *
	 * @param string $dir
	 * @return UITestCase
	 */
	public function assertDirectoryIsWritable( string $dir ) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										is_writable($dir)
									);
	}


	/*

	(*)assertArrayHasKey()
	(*)assertArrayHasValue()
	(*)assertLength()
	assertClassHasAttribute()
	assertClassHasStaticAttribute()
	(*)assertStringContainsString()
	(*)assertStringContainsStringIgnoringCase()
	assertContainsOnly()
	assertContainsOnlyInstancesOf()
	(*)assertCount()
	(*)assertDirectoryExists()
	(*)assertDirectoryIsReadable()
	(*)assertDirectoryIsWritable()
	(*)assertEmpty()
	(*)assertNotEmpty()
	assertEquals()
	assertEqualsCanonicalizing()
	assertEqualsIgnoringCase()
	assertEqualsWithDelta()
	assertObjectEquals()
	(*)assertFalse()
	assertFileEquals()
	assertFileExists()
	assertFileIsReadable()
	assertFileIsWritable()
	assertGreaterThan()
	assertGreaterThanOrEqual()
	assertInfinite()
	assertInstanceOf()
	assertIsArray()
	(*)assertIsBool()
	assertIsCallable()
	(*)assertIsFloat()
	assertIsInt()
	assertIsIterable()
	assertIsNumeric()
	assertIsObject()
	assertIsResource()
	assertIsScalar()
	(*)assertIsString()
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
	(*)assertTrue()
	assertXmlFileEqualsXmlFile()
	assertXmlStringEqualsXmlFile()
	assertXmlStringEqualsXmlString()
 	
	*/
	
}