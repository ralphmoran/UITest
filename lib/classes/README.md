# UITesting - Class examples

Shows class examples:

-- App\UITesting\Lib\Classes\UIFaker.php

```php
// Examples:

$faker = new UIFaker();

print_r(
	$faker->getFakeArray([
		// Associative
		'name:username|t:username',
		'name:email|type:email|mail:underdog|domain:com|prefix:rafael_test',
		'n:phone|t:phone',
		'n:dob|t:birthday',
		'n:street|t:street',
		'n:city|t:city',
		'n:statefull|t:statefull',
		'n:state|t:state',
		'n:country|t:country',
		'n:zipcode|t:int|max:5',
		'n:zip|type:zipcode|max:5',
		'name:charge|type:float|min:0|max:5|decimals:4',
		'name:salt|type:alpha|max:30',
		'name:payload_array|type:array|body:' . $faker->getFakeArray([
													'name:firstname|t:name',
													'name:lastname|t:name',
													'n:age|type:int|max:2',
													'n:address|t:address',
												], 
												true
											),
		'name:ws_json|type:json|body:' . $faker->getFakeJSON([
													'name:apikey|type:alpha|max:30',
													'name:secretkey|type:alpha|max:10',
												]),
		// Non-Associative
		'type:float|min:0|max:2',
		'type:int|min:0|max:2',
		'max:5',
	])
);
```

-- App\UITesting\Lib\Classes\UIFormater.php

```php
// Examples:
```

-- App\UITesting\Lib\Classes\UIMaker.php

```php
// Examples:
```

-- App\UITesting\Lib\Classes\UITestCase.php

```php
// Examples:
```

-- App\UITesting\Lib\Classes\UITester.php

```php
// Examples:
```
