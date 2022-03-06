<?php

$dirname = dirname(__FILE__);

// Autoloader
require_once $dirname . '/lib/autoload.php';

// Helper functions
require_once $dirname . '/lib/helper.functions.php';

// Examples
require_once $dirname . '/examples/functions.php';
require_once $dirname . '/examples/classes/classes.php';

// Use case
$tester = new UITester();

// Run all tests
$tester->all()
	->outputAssertionResults();

// Only specific tests
$tester->only('AirPlaneTest_94c91bedfa9be686afc373100b2e72f5')
	->outputAssertionResults();
