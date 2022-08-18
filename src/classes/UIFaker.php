<?php

namespace RafaelMoran\UITest;

class UIFaker
{
	private $lowercases = 'abcdefghijklmnopqrstuvwxyz';
	private $uppercases = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	private $numbers = '0123456789';
	private $chars = '!@#$%^&*()';

	/**
	 * Returns a fake array, also, it can return a JSON format string.
	 *
	 * @param array $options
	 * @param boolean $as_json
	 * @return mixed
	 */
	public function getFakeArray( array $options, bool $as_json = false )
	{
		if( empty($options) ) 
			return false;

		$fake_array = [];

		// Process each argument
		foreach( $options as $opt ){
			
			$format = [];
			$data   = explode("|", $opt);

			// Process each element
			foreach( $data as $i ){
				$trunks = ( $this->isSpecialType($opt) && strpos($i, 'body') !== false ) ? 2 : PHP_INT_MAX;
				$element = explode(":", $i, $trunks);
				$format[ $element[0] ] = $element[1];
			}

			// Assign default values
			if( ! array_key_exists('t', $format) && ! array_key_exists('type', $format) )
				$format['type'] = 'string';

			if( ! array_key_exists('min', $format) )
				$format['min'] = NULL;

			if( ! array_key_exists('max', $format) )
				$format['max'] = NULL;

			// Non-Associative array
			if( ! $this->isAssociative($format) ){
				$fake_array[] = $this->getValueFromType( $format );
				continue;
			}

			// "name"|"n" of the index (required for associative array)
			$format['name'] = ( array_key_exists('n', $format) ) ? $format['n'] : $format['name'] ;

			// Defaul index for type
			$format['type'] = ( array_key_exists('t', $format) ) ? $format['t'] : $format['type'] ;

			// Associative array
			$fake_array[ $format['name'] ] = $this->getValueFromType( $format );

		}

		return ($as_json) ? json_encode($fake_array) : $fake_array ;
	}

	/**
	 * Returns a fake JSON representation.
	 *
	 * @param array $array
	 * @return string
	 */
	public function getFakeJSON( array $array ) : string
	{
		return $this->getFakeArray( $array, true );
	}

	/**
	 * Returns a fake email address.
	 *
	 * @param string|NULL $username
	 * @param string $mail
	 * @param string $domain
	 * @return string
	 */
	public function getFakeEmail( string $username = NULL, 
									string $mail = 'fakercompany', 
									string $domain = 'com' ) : string
	{
		$username = is_null($username) 
					? strtolower($this->getFakeName()) 
					: $username . '-' . strtolower($this->getFakeName());

		$email    = $username . $this->getRandInteger(8) .'@' . $mail . '.' . $domain;

		if ( filter_var($email, FILTER_VALIDATE_EMAIL) )
			return $email;
		
		return NULL;
	}

	/**
	 * Returns a fake name between.
	 *
	 * @return string
	 */
	public function getFakeName() : string
	{
		return $this->getRandItemFromArray(['Ty',
						'Hugo',
						'Percy',
						'Jack',
						'Olive',
						'Fran',
						'John',
						'Ev',
						'Anne',
						'Cherry',
						'Glad',
						'Ginger',
						'Del',
						'Rose',
						'Perry',
						'Frank',
						'Roy',
						'Pat',
						'Percy',
						'Rod',
						'Hank',
						'Bridget',
						'Pat',
						'Karen',
						'Col',
						'Fay',
						'Joe',
						'Wes',
						'Colin',
						'Greg',
						'Toi']);
	}

	/**
	 * Returns a fake lastname.
	 *
	 * @return string
	 */
	public function getFakeLastname() : string
	{
		return $this->getRandItemFromArray(['Ayelloribbin',
						'First',
						'Vere',
						'Aranda',
						'Tree',
						'Pani',
						'Quil',
						'Lasting',
						'Thurium',
						'Blossom',
						'Oli',
						'Plant',
						'Phineum',
						'Bush',
						'Scope',
						'Stein',
						'Commishun',
						'Thettick',
						'Kewshun',
						'Knee',
						'Cheef',
						'Theriveaquai',
						'Toffis',
						'Onnabit',
						'Fays',
						'Daway',
						'Awl',
						'Yabinlatelee',
						'Sik',
						'Arias',
						'Story']);
	}

	/**
	 * Returns a fake username between $min and $max length.
	 *
	 * @return string
	 */
	public function getFakeUsername( string $connector = '.' ) : string
	{
		return strtolower($this->getFakeName()) . $connector . strtolower($this->getFakeName());
	}

	/**
	 * Returns a fake formatted birthday date.
	 *
	 * @return void
	 */
	public function getFakeBirthday()
	{
		return rand(1, 12) . '/' . rand(1, 31) . '/' . rand(1970, 2000);
	}

	/**
	 * Returns a fake formatted telephone number.
	 *
	 * @return void
	 */
	public function getFakePhoneNumber()
	{
		return rand(100, 999) . '-' . rand(100, 999) . '-' . rand(1000, 9999);
	}

	/**
	 * Returns a fake race name.
	 *
	 * @return string
	 */
	public function getFakeRace() : string
	{
		return $this->getRandItemFromArray(['Ivonian',
						'Kolluinae',
						'Mothinit',
						'Birrisin',
						'Hethanit',
						'Connesier',
						'Phossiavian',
						'Ziraesse',
						'Hollolese',
						'Visaino',
						'Zonnusum',
						'Yelarus',
						'Qhertaceous',
						'Bhiramoth',
						'Qhothoinae',
						'Drirtiphines',
						'Verviron',
						'Gnonnaiander',
						'Drecivin',
						'Aseonean',
						'Khathinee',
						'Boccevese',
						'Koriarid',
						'Bhoveadillo']);
	}

	/**
	 * Returns a fake street name.
	 *
	 * @return void
	 */
	public function getFakeStreet()
	{
		return $this->getRandItemFromArray(["Martin St.",
						"The Dell",
						"Bridge St.",
						"Richmond Av.",
						"Primrose Lane",
						"Chapel Lane",
						"Byron Road",
						"Falcon St.",
						"Bell Street",
						"Mulberry St.",
						"Home St.",
						"Nursery St.",
						"Pinfold Lane",
						"Cross Road",
						"Hall Road",
						"St John's St.",
						"Trinity Street",
						"New Street",
						"Church End",
						"Eastgate",
						"Maple Av.",
						"Broad Street",
						"Howard Road",
						"Holly Lane",
						"Sycamore Av."]);
	}

	/**
	 * Returns a fake city name.
	 * 
	 * @return string
	 */
	public function getFakeCity() : string
	{
		return $this->getRandItemFromArray(['Great Readingburgh',
						'Redbury',
						'Cruxby',
						'Sayborough',
						'Watercaster',
						'Riverness',
						'South Westworth',
						'Lunahampton',
						'Lexingcester Island',
						'Mannordale',
						'Farmhampton',
						'West Transview',
						'Parkburgh',
						'Capkarta',
						'Casterborough Island',
						'Massby',
						'Auland',
						'Great Middleborough',
						'Pinekarta',
						'Farmingby',
						'Great Sandborough',
						'Meddol',
						'Lawburg',
						'Auport',
						'Southingborough Park']);
	}

	/**
	 * Returns a fake full state name.
	 *
	 * @return string
	 */
	public function getFakeStateFull() : string
	{
		return $this->getRandItemFromArray(['North Alashire',
						'South Jeransas',
						'Yoio',
						'South Teiana',
						'South Virine',
						'South Teansas',
						'North Coloaii',
						'New Idaconsin',
						'Wisming',
						'East Wyorida',
						'Hawrgia',
						'Minneana',
						'Delaginia',
						'Hampnois',
						'New Pennware',
						'Missisington',
						'New Monlina',
						'Merida',
						'Virsota',
						'Oregan',
						'Teware',
						'Verah',
						'Louisine',
						'Indiho',
						'Tehoma',
					]);
	}
	
	/**
	 * Returns a fake abbreviated state name.
	 *
	 * @return string
	 */
	public function getFakeState() : string
	{
		return strtoupper($this->getRandString(2));
	}

	/**
	 * Returns a fake country name.
	 *
	 * @return string
	 */
	public function getFakeCountry() : string
	{
		return $this->getRandItemFromArray(['Wanraqna',
						'Nganor',
						'Statestu Bargomai',
						'Wayna Biaxi',
						'Leryce',
						'Auru',
						'Pabia',
						'New Nonsia',
						'Soi Ofgui',
						'Guyaau',
						'Vane',
						'Neaspain Seneda',
						'Komarkconited',
						'Mamayotte Poreda',
						'Pumo Tiusva',
						'Bougre Islandku',
						'Ditu Layandbar',
						'Mayenca',
						'Keriten',
						'Ntiniuege',
						'Fugeor',
						'Eastern Cotar',
						'Piatherngam',
						'Dadiabarji',
						'Isle of Hue']);
	}

	/**
	 * Returns a fake zip code between $min and $max length.
	 *
	 * @param integer $min
	 * @param integer|NULL $max
	 * @return integer
	 */
	public function getFakeZipcode( int $min = 1, int $max = NULL ) : int
	{
		return $this->getRandInteger($min, $max);
	}

	/**
	 * Returns a fake address.
	 *
	 * @return string
	 */
	public function getFakeAddress() : string
	{
		return $this->getRandInteger(5)
				. ' ' . $this->getFakeStreet()
				. ', ' . $this->getFakeCity()
				. ', ' . $this->getFakeState()
				. ' ' . $this->getFakeCountry()
				. ' ' . $this->getRandInteger(5);
	}

	/**
	 * Returns a random string between $min and $max length.
	 *
	 * @param integer|NULL $min
	 * @param integer|NULL $max
	 * @return string
	 */
	public function getRandString( int $min = NULL, int $max = NULL ) : string
	{
		$this->processRange($min, $max);

		$string = '';

		for( $i = 0; $i < rand($min, $max); $i++ )
			$string .= $this->lowercases[mt_rand(0, strlen($this->lowercases)-1)];

		return $string;
	}

	/**
	 * Returns a random integer between $min and $max.
	 *
	 * @param integer|NULL $min
	 * @param integer|NULL $max
	 * @return integer
	 */
	public function getRandInteger( int $min = NULL, int $max = NULL ) : int
	{
		$this->processRange($min, $max);

		$integer = '';

		for( $i = 0; $i < rand($min, $max); $i++ ){

			if( empty($number = $this->numbers[mt_rand(0, strlen($this->numbers)-1)]) && empty($integer) )
				$number = mt_rand(1, 9);

			$integer .= $number;

		}

		return (int) $integer;
	}

	/**
	 * Returns a random float number between $min and $max.
	 *
	 * @param integer|NULL $min
	 * @param integer|NULL $max
	 * @param integer $decimals
	 * @return float
	 */
	public function getRandFloat( int $min = NULL, int $max = NULL, int $decimals = 2 ) : float
	{
		$this->processRange($min, $max);

		return number_format($min + lcg_value() * abs($max - $min), $decimals);
	}

	/**
	 * Returns an alphanumeric string between $min and $max length.
	 *
	 * @param integer|NULL $min
	 * @param integer|NULL $max
	 * @return string
	 */
	public function getRandAlpha( int $min = NULL, int $max = NULL ) : string
	{
		$this->processRange($min, $max);

		$aplha = $this->lowercases . $this->uppercases . $this->numbers;

		return substr(str_shuffle(str_repeat($aplha, $max)), $min, $max);
	}

	/**
	 * Returns and processes the required value based on 
	 *
	 * @param array $format
	 * @return void
	 */
	private function getValueFromType( array $format )
	{
		// Based on type, return value
		switch( $format['type'] )
		{
			case 'name':
				$value = $this->getFakeName();
				break;

			case 'username':
				$value = $this->getFakeUsername();
				break;

			case 'phone':
				$value = $this->getFakePhoneNumber();
				break;

			case 'birthday':
				$value = $this->getFakeBirthday();
				break;
	
			case 'email':
				$prefix = NULL;
				$mail   = NULL;
				$domain = NULL;

				if( array_key_exists('mail', $format) )
					$mail = $format['mail'];

				if( array_key_exists('domain', $format) )
					$domain = $format['domain'];

				if( array_key_exists('prefix', $format) )
					$prefix = $format['prefix'];

				$value = $this->getFakeEmail($prefix, $mail, $domain);
				break;

			case 'zip':
			case 'zipcode':
				$value = $this->getRandInteger($format['min'], $format['max']);
				break;

			case 'street':
				$value = $this->getFakeStreet();
				break;
			
			case 'city':
				$value = $this->getFakeCity();
				break;

			case 'state':
				$value = $this->getFakeState();
				break;

			case 'statefull':
				$value = $this->getFakeStateFull();
				break;

			case 'country':
				$value = $this->getFakeCountry();
				break;

			case 'address':
				$value = $this->getFakeAddress();
				break;
		
			case 'int':
				$value = $this->getRandInteger($format['min'], $format['max']);
				break;
			
			case 'float':
				$decimals = 2;

				if( array_key_exists('decimals', $format) )
					$decimals = $format['decimals'];

				$value = $this->getRandFloat($format['min'], $format['max'], $decimals);
				break;

			case 'json':
				$body = [];

				if( array_key_exists('body', $format) )
					$body = $format['body'];

				$value = $body;
				break;

			case 'array':
				$body = [];

				if( array_key_exists('body', $format) )
					$body = json_decode($format['body'], true);

				$value = $body;
				break;

			case 'alpha':
				$value = $this->getRandAlpha($format['min'], $format['max']);
				break;

			case 'string':
			default:
				$value = $this->getRandString($format['min'], $format['max']);
		}

		return $value;
	}

	/**
	 * Defines the $min and $max values.
	 *
	 * @param integer|NULL $min
	 * @param integer|NULL $max
	 * @return void
	 */
	private function processRange( int &$min = NULL, int &$max = NULL )
	{
		if( is_null($max) && isset($min) )
			$max = $min;

		if( isset($max) && is_null($min) )
			$min = $max;

		if( is_null($max) && is_null($min) )
			$min = $max = 0;

		if( $min > $max ){
			$tmp = $max;
			$max = $min;
			$min = $tmp;
		}
	}

	/**
	 * Determines if element is array or json type.
	 *
	 * @param string $type
	 * @return boolean
	 */
	private function isSpecialType( string $type ) : bool
	{
		return ( strpos($type, ':array') !== false || strpos($type, ':json') !== false ) 
				? true 
				: false ;
	}

	/**
	 * Determines if array is associative or not.
	 *
	 * @param array $format
	 * @return boolean
	 */
	private function isAssociative( array $format ) : bool
	{
		return ( array_key_exists('n', $format) || array_key_exists('name', $format) )
				? true 
				: false ;
	}

	/**
	 * Returns a random item from an array.
	 *
	 * @param array $items
	 * @return string
	 */
	private function getRandItemFromArray( array $items ) : string
	{
		return $items[ array_rand($items) ];
	}

}
