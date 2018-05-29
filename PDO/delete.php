<?php

require_once 'database.php';

$id = base64_decode($_GET['key']);
try {
    $sql = 'DELETE FROM users WHERE id = '.$id;
    $statement = $dbh->prepare($sql);
    if ($statement->execute() && $statement->rowCount() > 0) {
        echo "\nUser deletion successful.\n";
    } else {
        echo "\nUser deletion failed.\n";
    }
    $dbh = null;
    header('Location:index.php');
} catch(PDOException $exception) {
    echo $exception->getMessage();
    die();
}
