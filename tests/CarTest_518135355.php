<?php
namespace App\UITesting\Tests;

use App\UITesting\Lib\Classes\UITestCase;

class CarTest_518135355 extends UITestCase
{
	/** @var string Name of the class or function to be used on this test. */
	protected $element = 'Car';

	/**
	 * Tests if (new Car)->getType() returns a non-empty string.
	 *
	 * @return void
	 */
	public function test_cartype_is_string_and_not_empty() : void
	{
		$car_type = (new \Car)->getType();

		$this->assertNotEmpty($car_type)
			->assertIsString($car_type);
	}

	/**
	 * Tests if values are float type.
	 *
	 * @return void
	 */
	public function test_if_value_is_float() : void
	{
		$this->assertIsFloat(27.25);
		$this->assertIsFloat('abc');
		$this->assertIsFloat(23);
		$this->assertIsFloat(23.5);
		$this->assertIsFloat(1e7);  // Scientific Notation
		$this->assertIsFloat(true);
	}
	
}