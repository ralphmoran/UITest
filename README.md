<h1 align="center">ralphmoran/uitest</h1>

<p align="center">
    A lightweight Unit and Integration(?) testing tool
</p>

<p align="center">
    <a href="https://github.com/ralphmoran/UITest"><img src="https://img.shields.io/badge/Source-ralphmoran/uitest-orange" alt="Source Code"></a>
    <a href="https://packagist.org/packages/rafael.moran/uitest"><img src="https://img.shields.io/badge/Release-v1.0-blue" alt="Download Package"></a>
    <a href="https://php.net"><img src="https://img.shields.io/badge/PHP-v7.2^-blue" alt="PHP Programming Language"></a>
    <a href="https://opensource.org/licenses/MIT"><img src="https://img.shields.io/badge/License-MIT-yellow.svg" alt="Read License"></a>
</p>

# UITesting

UITesting is an extremely light tool for Unit and (?)Integration testing.

## Installation

.env file

Copy and paste the next ENV variables into your .env file. In order to avoid namespace conflits, customize your own namespace:

```
PATH_TESTS=tests
TEST_CASE_TEMPLATE=vendor/rafael.moran/uitest/src/UITestCaseTemplate.tpl
TEST_NAMESPACE=<YouAppName>\UITesting\Tests
BASE_DIRNAME=
TEST_CASE_PREFIX=TestCase_
```

Create a new PHP file in your root directory, call it whatever you want, e.i.: `run-tests.php`, then add a new script in `scripts` section within `composer.json` using the new PHP filename:

```
...
"scripts": {
        "uitest" : "php ./run-tests.php",
        "uimaker" : "php vendor/rafael.moran/uitest/uimaker"
	}
...
```

You can execute your new command like:

```
$ composer uitest
```

Or you can use the REPL like:

```
$ composer uimaker -- -n=ClassNameX
```

## Creating a UITester instance



Use the package like another PHP one:

```php

// file: run-tests.php (you can pick whatever filename you want)
require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

// Entities to test
include __DIR__ . '/examples/functions.php';
include __DIR__ . '/examples/classes/Car.php';
include __DIR__ . '/examples/classes/AirPlane.php';


// Use case
$tester = new \RafaelMoran\UITest\UITester(['verbose' => true]); // set to false to not display details

// Run all tests
$tester->all();

```

## Usage: How to create a UITester

```php
use RafaelMoran\UITest\UITester;

// Use case
$tester = new UITester(); // It runs all test from $_ENV['PATH_TESTS'], results are not displayed.

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

There is a folder named `/tests/` where all your test cases will be saved by default when you create them via the REPL `uimaker`. You can save your tests in any other folder. In order to execute them you need to specify the new path like it was displayed above.

```php
namespace <YourAppName>\UITesting\Tests;

use RafaelMoran\UITest\UITestCase;

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

There is a small REPL that helps you to create new test cases, this REPL is `uimaker`

## Usage: How to use REPL uitest

```
$ cd uitesting // Or make an alias that point to `php uitest` globally
```


This command will create a new test case, named `ClassNameX`:

```
$ composer uimaker -n=ClassNameX
```

```php
namespace <YourAppName>\UITesting\Tests;

use RafaelMoran\UITest\UITestCase;

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
$ composer uimaker -n=FunctionNameX
OR 
$ composer uimaker --name=FunctionNameX
```

```php
namespace <YourAppName>\UITesting\Tests;

use RafaelMoran\UITest\UITestCase;

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
require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

// Examples
include __DIR__ . '/examples/functions.php';
include __DIR__ . '/examples/classes/Car.php';
include __DIR__ . '/examples/classes/AirPlane.php';

// Use case
$tester = new \RafaelMoran\UITest\UITester(['verbose' => true]); // set to false to not display details

// Run all tests
$tester->all();

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


## Copyright and License

The ralphmoran/uitest tool is copyright © [Rafael Moran](https://github.com/ralphmoran)
and licensed for use under the terms of the
MIT License (MIT). Please see [LICENSE](LICENSE) for more information.