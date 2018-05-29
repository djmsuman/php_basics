<?php

require_once 'database.php';

$id = base64_decode($_GET['key']);
$sql = 'SELECT * FROM users WHERE id = '.$id;
if ($statement = $mysqli->prepare($sql)) {
    $statement->execute();
    $statement->bind_result($id, $username, $email, $password);
    while ($statement->fetch()) {
        $user['id'] = $id;
        $user['username'] = $username;
        $user['email'] = $email;
        $user['password'] = $password;
    }
    $statement->close();
}
$mysqli->close();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>View User</title>
        <style>
        button {
            border: 1px solid #000;
            padding: 5px;
            display: block;
        }
        dt {
            font-weight: bold;
            display: block;
        }
        dd { display: block; }
        a { text-decoration: none; }
        </style>
    </head>
    <body>
        <a href="index.php">
            <button type="button">List all</button>
        </a>
        <dl>
            <dt>Username:</dt>
            <dd><?= $user['username'] ?></dd>
            <dt>Email:</dt>
            <dd><?= $user['email'] ?></dd>
            <dt>Password:</dt>
            <dd><?= $user['password'] ?></dd>
        </dl>
    </body>
</html>
