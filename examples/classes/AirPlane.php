<?php

class AirPlane{

	public function __construct() {}

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