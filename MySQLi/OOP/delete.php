<?php

require_once 'database.php';

$id = base64_decode($_GET['key']);
$sql = 'DELETE FROM users WHERE id = '.$id;
if ($statement = $mysqli->prepare($sql)) {
    $statement->execute();
    $statement->close();
}
$mysqli->close();
header('Location:index.php');
