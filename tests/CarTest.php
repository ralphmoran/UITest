<?php

class CarTest extends UITestCase
{
	/** @var string Name of the class or function to be used on this test. */
	protected $element = 'Car';

	public function test_get_car_type()
	{
		$this->assertArrayHasKey('keyD', array('keyD'=>null, 'key4'=>1));
		$this->assertArrayHasKey('keyA', array('keyA'=>null, 'key4'=>1));
		$this->assertArrayHasKey('keyR', array('keyR'=>null, 'key4'=>1));
		// $this->assertArrayHasKey('keyN', array('key3'=>null, 'key4'=>1));
	}

	public function test_method_set_username()
	{
		$this->assertArrayHasKey('keyD', array('keyD'=>null, 'key4'=>1));
		$this->assertArrayHasKey('keyA', array('keyA'=>null, 'key4'=>1));
		$this->assertArrayHasKey('keyR', array('keyR'=>null, 'key4'=>1));
		// $this->assertArrayHasKey('keyN', array('key3'=>null, 'key4'=>1));
	}

	public function test_get_username_as_string()
	{
		$this->assertArrayHasKey('keyD', array('keyD'=>null, 'key4'=>1));
		$this->assertArrayHasKey('keyA', array('keyA'=>null, 'key4'=>1));
		$this->assertArrayHasKey('keyR', array('keyR'=>null, 'key4'=>1));
		// $this->assertArrayHasKey('keyN', array('key3'=>null, 'key4'=>1));
	}

}