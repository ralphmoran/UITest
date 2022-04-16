# UITesting

UITesting is an extremely light tool for Unit and (?)Integration testing.

## Installation

Use the package like another PHP one

```php
$dirname = dirname(__FILE__);

// Include this file if you're using all the package
require_once $dirname . '/lib/uitest.functions.php';

// Your code here

```

## Usage: How to create a UITester

```php
// Create a UITester
require_once $dirname . '/lib/UITester.php';

// Use case
$tester = new UITester(); // It runs all test from env('PATH_TESTS'), results are not displayed.

// Or

// It's run all tests from `/another/real/weird/path/`
$tester = new UITester([
						"path" => "/another/real/weird/path/",
						"verbose" => true,
						// Or...
						"v" => true,
					]); 
```

## Run all tests

```php
/*
 * It runs all test cases from the default test folder `/tests/` 
 * and display in detail all assertions statuses.
 */
$tester->all(); 
	
// ...

/**
 * It runs all test cases from the default test folder `/another/test/folder/` 
 * and display in detail all assertions statuses.
 */
$tester->all("/another/test/folder/"); 
```
## Run only specific tests

```php
/**
 * It runs only `CarTest_518135355` from the default test folder `/tests/` 
 * and display in detail all assertions statuses.
 */
$tester->only('CarTest_518135355')
		->outputTestResults(); 

// ...

/**
 * It runs only `CarTest_518135355` and `GetRandomStrTest_1218383454` test cases 
 * from the default test folder `/tests/` and display in detail 
 * all assertions statuses.
 */
$tester->only([
		'CarTest_518135355',
		'GetRandomStrTest_1218383454'
	])
	->outputTestResults(); 

// ...

/**
 * It runs only `CarTest_518135355` from the default test folder 
 * `/another/real/weird/path/` and display in detail all assertions statuses.
 */
$tester->setPath('/another/real/weird/path/')
	->only('CarTest_518135355')
	->outputTestResults(); 
```

## Usage: How to create a UITestCase

All your test cases must extend from the abstract class `UITestCase` and all tests/methods must start with `test_` and return void. 

There is a folder named `/tests/` where all your test cases will be saved by default when you create them via the REPL `uitest`. You can save your tests in any other folder. In order to execute them you need to specify the new path like it was displayed above.

```php
// Create a UITesCase
require_once $dirname . '/lib/UITestCase.php';

// New test case needs to extend from abstract class UITestCase.
class CarTestCase extends UITestCase
{
	/**
	 * Tests if (new Car)->getType() returns a non-empty string.
	 *
	 * @return void
	 */
	public function test_cartype_is_string_and_not_empty() : void
	{
		$car_type = (new Car)->getType();

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
		$this->assertIsFloat(1e7);  // Scientific Notation. This is true.
		$this->assertIsFloat(true);
	}
	
}
```

There is a small REPL that helps you to create new test cases, this REPL is `uitest`

## Usage: How to use REPL uitest

```
$ cd uitesting // Or make an alias that point to `php uitest` globally
```


This command will create a new test case, named `ClassNameX`:

```
$ php uitest -n=ClassNameX
```

```php
class ClassNameXTestCase_518135355 extends UITestCase
{
	/**
	 * Tests if 'ClassNameXTestCase_518135355'...
	 *
	 * All tests MUST START WITH "test_".
	 *
	 * @return void
	 */
	public function test_() : void
	{
		/**
		 * Read ./lib/UITestCase.php file regarding assertions.
	 	 * 
	 	 * Examples:
	 	 * 
	 	 * $this->assertLength( 'abc', 3 ); # true
	 	 * $this->assertArrayHasKey('key3', array('key3'=>null, 'key4'=>1)); # true
		 */
	}
	
}
```

```
$ php uitest -n=FunctionNameX
OR 
$ php uitest --name=FunctionNameX
```

```php
class FunctionNameXTestCase_518135355 extends UITestCase
{
	/**
	 * Tests if 'FunctionNameXTestCase_518135355'...
	 *
	 * All tests MUST START WITH "test_".
	 *
	 * @return void
	 */
	public function test_() : void
	{
		/**
		 * Read ./lib/UITestCase.php file regarding assertions.
	 	 * 
	 	 * Examples:
	 	 * 
	 	 * $this->assertLength( 'abc', 3 ); # true
	 	 * $this->assertArrayHasKey('key3', array('key3'=>null, 'key4'=>1)); # true
		 */
	}
	
}
```

## Usage all-in-one

```php
$dirname = dirname(__FILE__);

// Helper functions
require_once $dirname . '/lib/uitest.functions.php';

// Load global config
load_env();

// Examples
require_once $dirname . '/examples/functions.php';
require_once $dirname . '/examples/classes/classes.php';

// Use case
$tester = new UITester(['verbose' => true]); // It displays all assertions in detail

// Or...

$tester = new UITester(['v' => true]); // It displays all assertions in detail

// ...

// Run all tests
$tester->all();
	
//...

// Only specific tests (string)
$tester->only('CarTest_518135355')
		->outputTestResults();
```
![Detailed results and final report](Details%20and%20final%20report.png)

```php

// ...

// Only specific tests (array)
$tester->only([
		'CarTest_518135355',
		'GetRandomStrTest_1218383454'
	])
	->outputTestResults();

```
![Final report](Final%20report.png)


## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
