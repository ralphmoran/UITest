# UITesting

UITesting is a extremely light tool for Unit and Integration testing.

## Installation

Use the package like other PHP one

```php
// Just include this file
require_once $dirname . '/lib/uitest.functions.php';
```

## Usage

```php
$dirname = dirname(__FILE__);

// Helper functions
require_once $dirname . '/lib/uitest.functions.php';

// Examples
require_once $dirname . '/examples/functions.php';
require_once $dirname . '/examples/classes/classes.php';

// Use case
$tester = new UITester();

// ...

// Run all tests
$tester->all()
	->outputAssertionResults(true); // It displays all assertions in detail and the final report

![alt text](https://user-images.githubusercontent.com/5456155/157128649-088ac925-019d-4fe8-af95-17d9e311ac13.png)

// ...

// Run all tests
$tester->all()
	->outputAssertionResults(); // It only displays the final report

/*
$ php index.php

UITest status: Passed! 

Total tests: 3 Total test cases: 4 Total assertions: 6 [✔6][x0]
*/

// ...

// Only specific tests (string)
$tester->only('CarTest_518135355')
	->outputAssertionResults(true); // It displays all assertions in detail and the final report

// ...

// Only specific tests (array)
$tester->only([
		'CarTest_518135355',
		'GetRandomStrTest_1218383454'
	])
	->outputAssertionResults(); // It only displays the final report
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
