<?php

final class UITester {

	/** @var array List of loaded tests. */
	private $loaded_tests = [];

	/** @var string Where all the test classes live in. */
	private $path = '';

	/** @var array Valid test extension. */
	private $extension = 'php';

	/** @var integer Total test cases. */
	private $total_test_cases = 0;

	/** @var integer Total tests. */
	private $total_tests = 0;

	/** @var integer Total assertions. */
	private $total_assertions = 0;

	/** @var integer Total assertions failed. */
	private $total_assertions_failed = 0;

	/** @var boolean Verbose. */
	private $verbose = false;

	/**
	 * Initial setup for tests
	 *
	 * @param array $opts
	 */
	public function __construct( $opts = [] )
	{
		$this->path = ( isset($opts['path']) && !empty($opts['path']) ) 
							? $opts['path']
							: env('PATH_TESTS');

		$this->verbose = isset($opts['verbose']) ? $opts['verbose'] : false;
	}

	/**
	 * Runs all tests from within $this->path.
	 *
	 * @param string $path Defines where to run the tests from.
	 * @return Tester
	 */
	public function all( string $path = '' )
	{
		if( ! empty($path) )
			$this->setPath($path);

		foreach(glob($this->path . '/*' . $this->extension) as $test)
			$this->only($test);

		if( $this->verbose )
			$this->outputTestResults();

		return $this;
	}

	/**
	 * Runs only a list of specific tests.
	 *
	 * @param array|string $tests
	 * @return mixed
	 */
	public function only( $tests )
	{
		if( empty( $tests ) )
			return false;

		if( is_string( $tests ) )
			$tests = array($tests);

		foreach($tests as $test){
			$this->logTestCaseResults( 
				$this->load_test( $test )
					->run(['verbose' => $this->verbose])
					->getTestCaseResults()
			);
		}

		if( $this->verbose )
			$this->outputTestResults();

		return $this;
	}

	/**
	 * Sets the general test path.
	 *
	 * @param string $path
	 * @return boolean|Tester
	 */
	public function setPath( $path )
	{
		if( empty( $path ) )
			return false;

		$this->path = rtrim($path, '/');

		return $this;
	}

	/**
	 * Gets the test result from run method.
	 *
	 * @return array
	 */
	public function getTestResults() : array
	{
		return [
			'test_cases'       => $this->total_test_cases,
			'tests'            => $this->total_tests,
			'assertions'       => $this->total_assertions,
			'assertion_failed' => $this->total_assertions_failed
		];
	}

	/**
	 * Outputs test results.
	 * 
	 * By default, verbose is false and will not output assertion status 
	 * as they run.
	 *
	 * @return void
	 */
	public function outputTestResults() : void
	{
		UIFormatter::setColor("\n\nUITest status:", "bgreen", $this->verbose);

		if ( $this->total_assertions_failed )
			UIFormatter::setColor(" Failed! ", "bgired", $this->verbose);

		if ( $this->total_assertions_failed == 0 )
			UIFormatter::setColor(" Passed! ", "bigreen", $this->verbose);

		UIFormatter::setColor("\n\n", "", $this->verbose);
		UIFormatter::setColor("Total test cases:", "yellow", $this->verbose);
		UIFormatter::setColor(" " . $this->total_test_cases, "white", $this->verbose);

		UIFormatter::setColor(" Total tests:", "yellow", $this->verbose);
		UIFormatter::setColor(" " . $this->total_tests, "white", $this->verbose);

		UIFormatter::setColor(" Total assertions:", "yellow", $this->verbose);
		UIFormatter::setColor(" " . $this->total_assertions, "white", $this->verbose);

		UIFormatter::setColor(" [", "", $this->verbose);
		UIFormatter::setColor(UIFormatter::$check_mark, "green", $this->verbose);
		UIFormatter::setColor(( $this->total_assertions - $this->total_assertions_failed ), "", $this->verbose);
		UIFormatter::setColor("]", "", $this->verbose);

		UIFormatter::setColor("[", "", $this->verbose);
		UIFormatter::setColor("x", "red", $this->verbose);
		UIFormatter::setColor("{$this->total_assertions_failed}", "", $this->verbose);
		UIFormatter::setColor("]\n", "", $this->verbose);

		// Signature
		UIFormatter::setColor("\nUITest v0.0", "bgdray", $this->verbose);
		UIFormatter::setColor("\nAuthor: Rafael Moran", "bgdray", $this->verbose);
		UIFormatter::setColor("\nCopyright 2022, All rights reserved.", "bgdray", $this->verbose);
	}

	/**
	 * Autoloader: This autoloader prevents an exploit attack.
	 * 
	 * PHP include & require exposes the current context to the included file.
	 * 
	 * @link https://github.com/Respect/Loader/issues/6
	 * @link https://owasp.org/www-community/vulnerabilities/PHP_Object_Injection
	 *
	 * @param string $test
	 * @return mixed
	 * @throws Exception If $test does not exist or class couldn't be loaded.
	 */
	private function load_test( $test )
	{
		$test_name = $this->getTestName( $test );

		if( ! in_array( $test_name, $this->loaded_tests ) ){

			$test = $this->path . "/" . $test_name . ".".  $this->extension;

			file_loader( $test );
			
			$this->loaded_tests[] = $test_name;
		}

		return new $test_name;
	}

	/**
	 * Parses a path/file test format and returns the test name.
	 *
	 * @param string $file
	 * @param string $ext
	 * @return string
	 */
	private function getTestName( $file, $ext = 'php' ) : string
	{
		$test_name = explode( '/', $file );

		return rtrim( end( $test_name ), '.' . $ext );
	}

	/**
	 * Logs all totals from the test.
	 *
	 * @param array $results
	 * @return void
	 */
	private function logTestCaseResults( array $results ) : void
	{
		if( empty($results) )
			return;

		$this->total_test_cases++;
		$this->total_tests += $results['tests'];
		$this->total_assertions += $results['assertions'];
		$this->total_assertions_failed += $results['assertions_failed'];

	}

}