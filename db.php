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
}
?>