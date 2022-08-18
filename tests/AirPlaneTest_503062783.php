<?php
namespace RafaelMoran\UITesting\Tests;

use RafaelMoran\UITest\UITestCase;

class AirPlaneTest_503062783 extends UITestCase
{
	/** @var string Name of the class or function to be used on this test. */
	protected $element = 'AirPlane';

	/**
	 * Tests if 'AirPlane' getType method returns a non-empty string.
	 *
	 * @return void
	 */
	public function test_if_gettype_returns_string_and_no_empty() : void
	{
		$airplane_type = (new \AirPlane)->getType();

		$this->assertIsString($airplane_type)
			->assertNotEmpty($airplane_type);
	}
	
}