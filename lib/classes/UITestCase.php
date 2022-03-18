<?php

abstract class UITestCase
{
	use StringAssertions,
		ArrayAssertions,
		BooleanAssertions,
		ClassAssertions,
		FileAssertions,
		MiscAssertions,
		NumericAssertions,
		ObjectAssertions;

	/** @var string Name of the class or function to be used. */
	protected $element = '';

	/** @var array Assertion statuses. */
	private $assertion_status = [];

	/**
	 * Method run() will perform all assertions from UITestCase instances.
	 *
	 * @return UITestCase
	 */
	public function run() : UITestCase
	{
		if( ! function_exists($this->element) && ! class_exists($this->element) ){
			$this->logAssertionStatus($this->element, 
										array("error" => "$this->element does not exist."), 
										false
									);
			return $this;
		}

		$test_case = get_class(debug_backtrace()[0]['object']);

		$this->assertion_status[ $test_case ] = []; 

		foreach( get_class_methods($test_case) as $method )
			if( strpos($method, 'test_') === 0 )
				call_user_func( array($this, $method) );

		return $this;
	}

	/**
	 * Logs all assertion statuses.
	 *
	 * @param string $name
	 * @param array $args
	 * @param boolean $status
	 * @return UITestCase
	 */
	private function logAssertionStatus(string $name, array $args, bool $status = true) : UITestCase
	{
		// Tracking back the parent method that called the assertion
		$this->assertion_status[ debug_backtrace()[2]['class'] ][ debug_backtrace()[2]['function'] ][] = get_defined_vars();

		return $this;
	}

	/**
	 * Returns private property $this->assertion_status array.
	 *
	 * @return array
	 */
	public function getAssertionStatus() : array
	{
		return $this->assertion_status;
	}
	
	/*
	assertClassHasAttribute()
	assertClassHasStaticAttribute()
	assertContainsOnly()
	assertContainsOnlyInstancesOf()
	assertEqualsCanonicalizing()
	assertEqualsIgnoringCase()
	assertObjectEquals()
	assertInstanceOf()
	assertObjectHasAttribute()
	assertMatchesRegularExpression()
	assertThat()
	*/
	
}