<?php
require_once './Models/Weather_Model.php';

class Weather {

	function __construct($city){
		$this->weather_model = new Weather_Model($city);
	}

	/**
	http://local.mvc.com/Weather/getReport/bangalore
	Call to model to fetch api data
	*/
	function getReport(){
		//Call to weather model to fetch api data
        return $this->weather_model->fetchCityWeather();
	}

}

?>