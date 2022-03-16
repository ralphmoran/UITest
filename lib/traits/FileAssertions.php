<?php

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
}