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
$tester = new \App\UITesting\Lib\Classes\UITester(['verbose' => true]);

// Run all tests
$tester->all();

// Only specific tests (string)
// $tester->only('CarTest_518135355')
//         ->outputTestResults();

// Only specific tests (array)
// $tester->only([
// 		'CarTest_518135355',
// 		'GetRandomStrTest_1218383454'
// 	]);
