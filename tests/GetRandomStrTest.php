<?php

class GetRandomStrTest extends UITestCase
{
	/** @var string Name of the class or function to be used on this test. */
	protected $element = 'getRandomStr';

	/**
	 * Tests if 'getRandomStr' returns length of 3.
	 *
	 * @return void
	 */
	public function test_return_length_of_3() : void
	{
		// $this->assertLength( getRandomStr(1), 3 );
		$this->assertLength( getRandomStr(5), 5 );
		$this->assertLength( getRandomStr(6), 6 );
		$this->assertLength( getRandomStr(7), 7 );
		// $this->assertLength( getRandomStr(15), 5 );
		// $this->assertLength( getRandomStr(40), 40 );
		$this->assertLength( getRandomStr(0), 0 );

		$this->assertArrayHasKey('key3', array('key3'=>null, 'key4'=>1));
		// $this->assertArrayHasKey('keyA', array('key3'=>null, 'key4'=>1));
	}

	/**
	 * Tests if 'array' has $key.
	 *
	 * @return void
	 */
	public function test_key_exists_in_array() : void
	{
		$this->assertArrayHasKey('key3', array('key3'=>null, 'key4'=>1));
		// $this->assertArrayHasKey('keyA', array('key3'=>null, 'key4'=>1));
		$this->assertArrayHasKey('keyB', array('keyB'=>null, 'key4'=>1));
		$this->assertArrayHasKey('keyC', array('keyC'=>null, 'key4'=>1));

		$this->assertLength( getRandomStr(6), 6 );
		$this->assertLength( getRandomStr(7), 7 );
	}
}