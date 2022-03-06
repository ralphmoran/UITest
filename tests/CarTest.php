<?php

class CarTest extends UITestCase
{
	/** @var string Name of the class or function to be used on this test. */
	protected $element = 'Car';

	public function test_cartype_is_string()
	{
		$this->assertIsString((new Car)->getType());
	}

}