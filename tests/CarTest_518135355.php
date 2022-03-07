<?php

class CarTest_518135355 extends UITestCase
{
	/** @var string Name of the class or function to be used on this test. */
	protected $element = 'Car';

	/**
	 * Tests if (new Car)->getType() returns a non-empty string.
	 *
	 * @return void
	 */
	public function test_cartype_is_string_and_not_empty()
	{
		$car_type = (new Car)->getType();

		$this->assertNotEmpty($car_type)
			->assertIsString($car_type);
	}
	
}