<?php

$dsn = 'mysql:host=localhost;dbname=test;charset=utf8';
$username = 'root';
$password = 'secret';

try {
    $dbh = new PDO($dsn, $username, $password);
} catch(PDOException $exception) {
    echo $exception->getMessage();
}
