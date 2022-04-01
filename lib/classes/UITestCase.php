<?php
namespace App\UITesting\Lib\Classes;
abstract class UITestCase
{
	use \App\UITesting\Lib\Traits\StringAssertions,
		\App\UITesting\Lib\Traits\ArrayAssertions,
		\App\UITesting\Lib\Traits\BooleanAssertions,
		\App\UITesting\Lib\Traits\ClassAssertions,
		\App\UITesting\Lib\Traits\FileAssertions,
		\App\UITesting\Lib\Traits\MiscAssertions,
		\App\UITesting\Lib\Traits\NumericAssertions,
		\App\UITesting\Lib\Traits\ObjectAssertions;

	/** @var array Assertion statuses. */
	private $assertion_status = [];

	/** @var integer Test counter. */
	private $test_counter = 0;

	/** @var integer Assertion counter. */
	private $assertion_counter = 0;

	/** @var integer Assertion failed counter. */
	private $assertion_failed_counter = 0;

	/** @var boolean Verbose. */
	private $verbose = false;

	/**
	 * Method run() will perform all assertions from UITestCase instances.
	 *
	 * @param array $opts
	 * @return UITestCase
	 */
	public function run( array $opts = [] ) : UITestCase
	{
		$this->verbose = isset($opts['verbose']) ?  $opts['verbose'] : false;

		// Proceed to execute test case
		$test_case = get_class(debug_backtrace()[0]['object']);

		UIFormatter::setColor("\n" . $test_case . "\n", "bgreen", $this->verbose);
		
		foreach( get_class_methods($test_case) as $method ){

			if( strpos($method, 'test_') === 0 ){

				UIFormatter::setColor("\n" . $method . "\n", "yellow", $this->verbose);

				$this->test_counter++;

				call_user_func( [$this, $method] );
			}

		}

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
		$variables = '';
		$icon	= UIFormatter::$check_mark;
		$color = "green";

		foreach ($args as $index => $value){
			$variables .= "$index=>" . ( is_array($value) ? json_encode($value) : $value ) . ", ";
		}

		if( ! $status ){
			$this->assertion_failed_counter++;
			$color = "red";
			$icon = "x";
		}

		UIFormatter::setColor($icon, $color, $this->verbose);
		UIFormatter::setColor(" " . $name . ": " . rtrim($variables, ', ') . "\n", "white", $this->verbose);

		$this->assertion_counter++;

		// Tracking back the parent method that called the assertion
		$this->assertion_status[ debug_backtrace()[2]['class'] ][ debug_backtrace()[2]['function'] ][] = get_defined_vars();

		flush();

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

	/**
	 * Returns the current test case results.
	 *
	 * @return array
	 */
	public function getTestCaseResults() : array
	{
		return [
			'tests'             => $this->test_counter,
			'assertions'        => $this->assertion_counter,
			'assertions_failed' => $this->assertion_failed_counter,
		];
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