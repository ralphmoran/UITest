<?php
namespace RafaelMoran\UITest\Traits;

use RafaelMoran\UITest\UITestCase;

trait FileAssertions
{
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
										( is_dir($dir) &&  is_readable($dir) )
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
										( is_dir($dir) && is_writable($dir) )
									);
	}

	/**
	 * Asserts if 2 strings are equal.
	 * 
	 * Note that his assertion is binary safe.
	 *
	 * @param string $string1
	 * @param string $string2
	 * @return UITestCase
	 */
	public function assertFileEquals( string $string1, string $string2 ) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										( strcmp( $string1, $string2 ) )
									);
	}


	/**
	 * Asserts if $file exists and is a regular file.
	 *
	 * @param string $file
	 * @return UITestCase
	 */
	public function assertFileExists( string $file ) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										is_file( $file )
									);
	}


	/**
	 * Asserts if $file exists and is readable.
	 *
	 * @param string $file
	 * @return UITestCase
	 */
	public function assertFileIsReadable( string $file ) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										( is_file($file) && is_readable( $file ) )
									);
	}


	/**
	 * Asserts if $file exists and is writable.
	 * 
	 * Note that this assertion could check if $file is a dir and is writable too.
	 *
	 * @param string $file
	 * @return UITestCase
	 */
	public function assertFileIsWritable( string $file ) : UITestCase
	{
		return $this->logAssertionStatus(__FUNCTION__, 
										get_defined_vars(), 
										( is_file($file) && is_writable( $file ) )
									);
	}
}