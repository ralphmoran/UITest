<?php

class GetRandomStrTest_1c0276e5935024b2710db8396e5ac869 extends UITestCase
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
		$this->assertLength( getRandomStr(3), 3 )
			->assertLength( getRandomStr(3), 3 )
			->assertLength( getRandomStr(3), 3 )
			->assertLength( getRandomStr(3), 3 )
			->assertLength( getRandomStr(3), 3 )
			->assertLength( getRandomStr(3), 3 )
			->assertLength( getRandomStr(3), 3 )
			->assertLength( getRandomStr(3), 3 )
			->assertLength( getRandomStr(3), 3 )
			->assertLength( getRandomStr(3), 3 )
			->assertLength( getRandomStr(3), 3 )
			->assertLength( getRandomStr(3), 3 );
	}
	
}