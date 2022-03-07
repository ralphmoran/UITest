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
	
//...

// Only specific tests (string)
$tester->only('CarTest_518135355')
	->outputAssertionResults(true); // It displays all assertions in detail and the final report
```
![Detailed results and final report](Details%20and%20final%20report.png)

```php


// ...

// Run all tests
$tester->all()
	->outputAssertionResults(); // It only displays the final report

// ...

// Only specific tests (array)
$tester->only([
		'CarTest_518135355',
		'GetRandomStrTest_1218383454'
	])
	->outputAssertionResults(); // It only displays the final report

```
![Final report](Final%20report.png)


## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
