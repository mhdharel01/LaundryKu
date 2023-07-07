<?php

function getConnection(): PDO
{

    $host = 'localhost';
    $port = 3306;
    $dbname = "v3";
    $username = 'root';
    $password = '';

    return new PDO("mysql:host=$host:$port;dbname=$dbname", $username, $password);
}
