<?php

$host = 'localhost';
$dbname = 'test';
$username = 'root';
$password = 'secret;

$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
