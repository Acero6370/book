<?php

$host = 'localhost';
$database = 'book';
$username = 'root';
$password = '';

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_error . ') '. $mysqli->connect_error);
}

?>
