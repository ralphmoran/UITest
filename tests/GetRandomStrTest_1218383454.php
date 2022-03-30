<?php
// namespace App\UITests;

use App\UITesting\Lib\Classes\UITestCase;
class GetRandomStrTest_1218383454 extends UITestCase
{
	/** @var string Name of the class or function to be used on this test. */
	protected $element = 'GetRandomStr';

	/**
	 * Tests if 'getRandomStr' returns length of 3.
	 *
	 * @return void
	 */
	public function test_return_length_of_3() : void
	{
		$this->assertLength( getRandomStr(3), 3 );
	}

	/**
	 * Tests if 'array' has $key.
	 *
	 * @return void
	 */
	public function test_key_exists_in_array() : void
	{
		$this->assertArrayHasKey('key3', array('key3'=>null, 'key4'=>1));
	}

}