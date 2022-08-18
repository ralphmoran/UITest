<?php
namespace RafaelMoran\UITest\Traits;

use RafaelMoran\UITest\UITestCase;

trait StringAssertions
{
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
	 * Asserts if $haystack starts with $needle.
	 * 
	 * Note that this assertion is case-sensitive and binary safe.
	 *
	 * @param string $haystack
	 * @param string $needle
	 * @return UITestCase
	 */
	public function assertStringStartsWith( string $haystack, string $needle ) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										( strncmp( $haystack, $needle, 0, strlen($needle) ) === 0 )
									);
	}

	/**
	 * Asserts if $haystack ends with $needle.
	 * 
	 * Note that this assertion is case-sensitive and binary safe.
	 *
	 * @param string $haystack
	 * @param string $needle
	 * @return UITestCase
	 */
	public function assertStringEndsWith( string $haystack, string $needle ) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										( strncmp( $haystack, $needle, -strlen($needle) ) === 0 )
									);
	}
}

