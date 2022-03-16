<?php

final class UITester {

	/** @var array List of loaded tests. */
	private $loaded_tests = [];

	/** @var string Where all the test classes live in. */
	private $path = './tests';

	/** @var array Keeps all the test results. */
	private $test_results = [];

	/** @var array Valid test extension. */
	private $extension = 'php';

	/**
	 * Initial setup for tests
	 *
	 * @param array $config
	 */
	public function __construct( $config = [] )
	{
		$this->path = ( isset($config['path']) && !empty($config['path']) ) 
							? $config['path']
							: $this->path;
	}

	/**
	 * Runs all tests from within $this->path.
	 *
	 * @param string $path Defines where to run the tests from.
	 * @return Tester
	 */
	public function all( string $path = '' )
	{
		if( ! empty($this->path) )
			$this->setPath($path);

		foreach(glob($this->path . '/*' . $this->extension) as $test)
			$this->only($test);

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

		foreach($tests as $test)
			$this->registerTestResult( 
				$this->load_test( $test )
					->run()
					->getAssertionStatus()
			);

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
		return $this->test_results;
	}

	/**
	 * Outputs assertion results.
	 * 
	 * By default, verbose is true and will output all assertion status 
	 * as they run.
	 *
	 * @return void
	 */
	public function outputAssertionResults( bool $verbose = false ) : void
	{
		UIFormatter::formatAndOutput($this->test_results, $verbose);
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

			try {
				# Confirm if the test was loaded properly
				if( ! class_exists( $test_name ) ){
					throw new Exception('Test: ' . $test_name . ' does not exist.');
					return NULL;
				}
			} catch (Exception $e){
				echo $e->getMessage() . "\n";
			}
			
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
	 * Registers the individual test result into $this->test_results array.
	 *
	 * @param array $result
	 * @return void
	 */
	private function registerTestResult( array $result ) : void
	{
		if( ! empty($result) )
			$this->test_results = array_merge($this->test_results, $result);
	}

}