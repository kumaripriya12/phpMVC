<?php

/**
Model files are required in MVC to do api calls and database changes
*/
class Weather_Model
{
    protected $db = null;

    function __construct($city_name)
    {
        $this->city_name = $city_name;
        $this->db = DB::connToDB();

    }

    /**
        Function to call api
        After getting api data, insert weather report in database
    */
    public function fetchCityWeather()
    {
        //Curl call to detch api data
        $url = BASE_API . "?q=" . $this->city_name . "&appid=" . API_KEY; 
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        try {
            if ( !empty($result) ) {
                //Call function to insert weather data in table
                $this->insertDataToTable($result);
            }
            else {
                return false; 
                exit();
            }
        } catch (Exception $e) {
            
        }
    }

    public function insertDataToTable($weatherData)
    {
        //json decode to decode tha data into array
        $weatherData = json_decode($weatherData, true);
        
        $data = [
            'city_name'           => $weatherData['name'],
            'city_id'             => $weatherData['id'],
            'temp'                => $weatherData['main']['temp'],
            'feels_like'          => $weatherData['main']['feels_like'],
            'min_temp'            => $weatherData['main']['temp_min'],
            'max_temp'            => $weatherData['main']['temp_max'],
            'pressure'            => $weatherData['main']['pressure'],
            'humidity'            => $weatherData['main']['humidity'],
            'visibility'          => $weatherData['visibility'],
            'weather'             => $weatherData['weather'][0]['main']
            'weather_description' => $weatherData['weather'][0]['description'],
            
        ];

        if(!$this->db->tableExists()){

        }
        //insert data into table
        $sql = "INSERT INTO weather_report (city_id, city_name, temp, feels_like, min_temp, max_temp, pressure, humidity, visibility, weather, weather_description) VALUES (:city_id, :city_name, :temp, :feels_like, :min_temp, :max_temp, :pressure, :humidity, :visibility, :weather, :weather_description)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);

    }
}

?>