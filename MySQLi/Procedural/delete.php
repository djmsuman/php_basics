<?php

require_once 'database.php';

$id = base64_decode($_GET['key']);
$sql = 'DELETE FROM users WHERE id = '.$id;
mysqli_query($mysqli, $sql);
mysqli_close($mysqli);
header('Location:index.php');
