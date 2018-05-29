<?php

require_once 'database.php';

$data = $_POST;
try {
    if (isset($data['submit'])) {
        $sql = 'INSERT INTO users (username, email, password) VALUES (:username, :email, :password)';
        $statement = $dbh->prepare($sql);
        $statement->bindValue(':username', $data['username']);
        $statement->bindValue(':email', $data['email']);
        $statement->bindValue(':password', md5($data['password']));
        if ($statement->execute()) {
            echo "\nUser creation successful.\n";
        } else {
            echo "\nUser creation failed.\n";
        }
        $dbh = null;
    }
} catch(PDOException $exception) {
    echo $exception->getMessage();
    die();
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>New User</title>
        <style>
        input, button {
            border: 1px solid #000;
            padding: 5px;
            display: block;
        }
        a { text-decoration: none; }
        </style>
    </head>
    <body>
        <a href="index.php">
            <button type="button">List all</button>
        </a>
        <br />
        <form action="" method="post" role="form">
            <input type="text" name="username" value="" placeholder="Username" />
            <br />
            <input type="email" name="email" value="" placeholder="Email" />
            <br />
            <input type="password" name="password" value="" placeholder="Password" />
            <br />
            <button type="submit" name="submit">Create</button>
        </form>
    </body>
</html>
