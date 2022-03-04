<?php
# Helper functions
include_once 'lib/helper.functions.php';

# include UITestCase class and Tester class
include_once 'lib/UIFormatter.php';
include_once 'lib/UITestCase.php';
include_once 'lib/UITester.php';

# Include functions
include_once 'testcases/functions.php';

# Include classes
include_once 'testcases/classes/classes.php';


$tester = new UITester();

$tester->only('GetRandomStrTest')
	->outputAssertionResults();

