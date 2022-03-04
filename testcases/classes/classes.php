<?php 

class Car{

	public function __construct(){}

	/**
	 * Returns rando car type
	 *
	 * @return string
	 */
	public function getType() : string
	{
		$car_type = array('suv', 'truck', 'compact');
		
		return $car_type[array_rand($car_type)];
	}
}

//...

class AirPlane{

	public function __construct(){}

	/**
	 * Returns rando airplane type
	 *
	 * @return string
	 */
	public function getType() : string
	{
		$airplane_type = array('jet', 'jumbo');

		return $airplane_type[array_rand($airplane_type)];
	}
}