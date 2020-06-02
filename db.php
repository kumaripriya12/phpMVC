<?php

/**
    DB class to connect to database
*/
class DB{

    // Define constants
    const USER = "root";
    const PASS = '';
    const HOST = "localhost";
    const DB   = "weather";

    //Function to connect to databse
    public static function connToDB() {

        $user = self::USER;
        $pass = self::PASS;
        $host = self::HOST;
        $db   = self::DB;

        $conn = new PDO("mysql:dbname=$db;host=$host", $user, $pass);
        return $conn;

    }

    //Check if table exists
    function tableExists() {
        $user = self::USER;
        $pass = self::PASS;
        $host = self::HOST;
        $db   = self::DB;

        $conn = new PDO("mysql:dbname=$db;host=$host", $user, $pass);
        
        // Try a select statement against the table
        // Run it in try/catch in case PDO is in ERRMODE_EXCEPTION.
        try {
            $result = $pdo->query("SELECT 1 FROM weather_report LIMIT 1");
        } catch (Exception $e) {
            // We got an exception == table not found
            return FALSE;
        }

        // Result is either boolean FALSE (no table found) or PDOStatement Object (table found)
        return $result !== FALSE;
    }

    function createTable(){

        $table = "tcompany";
        try {
            $user = self::USER;
            $pass = self::PASS;
            $host = self::HOST;
            $db   = self::DB;

            $conn = new PDO("mysql:dbname=$db;host=$host", $user, $pass);
             $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//Error Handling
             $sql ="CREATE table weather_report(
             city_id INT( 11 ) PRIMARY KEY,
             city_name VARCHAR( 50 ) NOT NULL, 
             temp INT( 20 ) NOT NULL,
             feels_like INT( 20 ) NOT NULL, 
             min_temp INT( 20 ) NOT NULL, 
             max_temp INT( 20 ) NOT NULL, 
             pressure VARCHAR( 100 ) NOT NULL,
             humidity VARCHAR( 50 ) NOT NULL,
             visibility VARCHAR( 50 ) NOT NULL,
             weather VARCHAR( 50 ) NOT NULL,
             weather_description VARCHAR( 50 ) NOT NULL,
             );" ;
             $db->exec($sql);
             print("Created $table Table.\n");

        } catch(PDOException $e) {
            echo $e->getMessage();//Remove or change message in production code
        }
    }

}
?>