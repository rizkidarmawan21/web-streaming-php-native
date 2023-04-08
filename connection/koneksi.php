<?php

error_reporting(0);
//  Koneksi ke database menggunakan PDO PHP Data Object

function koneksi(): PDO
{
    $host      = "localhost";
    $port      = 3306;
    $database  = "stream-php-native";
    $username  = "root";
    $password  = "";

    try {
        //code...
        return new PDO("mysql:host=$host:$port;dbname=$database", $username, $password);
    } catch(PDOException $e){
        die($e->getMessage());
    }
}
