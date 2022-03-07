<?php

$dirname = dirname(__FILE__);

// Helper functions
require_once $dirname . '/lib/helper.functions.php';

// Examples
require_once $dirname . '/examples/functions.php';
require_once $dirname . '/examples/classes/classes.php';

// Use case
$tester = new UITester();

// Run all tests
$tester->all()
	->outputAssertionResults(true);

// Only specific tests (string)
// $tester->only('CarTest_e9f69bb51defb4bff6a680f4981fb4cf')
// 	->outputAssertionResults(true);

// Only specific tests (array)
// $tester->only([
// 		'AirPlaneTest_94c91bedfa9be686afc373100b2e72f5',
// 		'GetRandomStrTest_1c0276e5935024b2710db8396e5ac869'
// 	])
// 	->outputAssertionResults();
