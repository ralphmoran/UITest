<?php

require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

/*
|--------------------------------------------------------------
|	UITest is a lightweight package to make Unit and 
|	Integration (pending) testing easier and simpler.
|----------------------------------------------------------------
*/

// Examples
include __DIR__ . '/examples/functions.php';
include __DIR__ . '/examples/classes/Car.php';
include __DIR__ . '/examples/classes/AirPlane.php';


// Use case
$tester = new \RafaelMoran\UITest\UITester(['verbose' => true]); // set to false to not display details

// Run all tests
$tester->all();

// Only specific tests (string)
// $tester->only('CarTest_518135355')
// 		->outputTestResults();

// Only specific tests (array)
// $tester->only([
// 		'CarTest_518135355',
// 		'GetRandomStrTest_1218383454'
// 	])
// 	->outputTestResults();
