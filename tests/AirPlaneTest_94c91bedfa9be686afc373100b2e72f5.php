<?php

class AirPlaneTest_94c91bedfa9be686afc373100b2e72f5 extends UITestCase
{
	/** @var string Name of the class or function to be used on this test. */
	protected $element = 'AirPlane';

	/**
	 * Tests if (new AirPlane)->getType() returns a non-empty string.
	 *
	 * @return void
	 */
	public function test_airplanetype_is_string()
	{
		$this->assertIsString((new AirPlane)->getType());
	}

}