<?php

use RafaelMoran\UITest\UITester;

require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

/*
|--------------------------------------------------------------
|	
|
|----------------------------------------------------------------
*/

// Examples
include __DIR__ . '/examples/functions.php';
include __DIR__ . '/examples/classes/Car.php';
include __DIR__ . '/examples/classes/AirPlane.php';


// Use case
$tester = new UITester(['verbose' => true]); // set to false to not display details

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
