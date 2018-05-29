<?php

$host = 'localhost';
$dbname = 'test';
$username = 'root';
$password = 'secret';

$mysqli = mysqli_connect($host, $username, $password, $dbname);

if (!$mysqli) {
    echo die("Connection failed: " . mysqli_connect_error());
}
