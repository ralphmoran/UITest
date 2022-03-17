<?php


$dirname = dirname(__FILE__);

// Helper functions
require_once $dirname . '/lib/uitest.functions.php';

// Load global config
load_env();

// Examples
require_once $dirname . '/examples/functions.php';
require_once $dirname . '/examples/classes/classes.php';

// Use case
$tester = new UITester();

// Run all tests
$tester->all()
	->outputAssertionResults(true);

// Only specific tests (string)
// $tester->only('CarTest_518135355')
// 	->outputAssertionResults(true);

// Only specific tests (array)
// $tester->only([
// 		'CarTest_518135355',
// 		'GetRandomStrTest_1218383454'
// 	])
// 	->outputAssertionResults();
