<?php

require_once 'database.php';

$id = base64_decode($_GET['key']);
$data = $_POST;
try {
    $sql = 'SELECT * FROM users WHERE id = '.$id;
    $statement = $dbh->prepare($sql);
    if ($statement->execute() && $statement->rowCount() > 0) {
        $user = $statement->fetch(PDO::FETCH_OBJ);
    }
    if (isset($data['submit'])) {
        $sql = 'UPDATE users SET username = :username, email = :email, password = :password WHERE id = '.$id;
        $statement = $dbh->prepare($sql);
        $statement->bindValue(':username', $data['username']);
        $statement->bindValue(':email', $data['email']);
        $statement->bindValue(':password', md5($data['password']));
        if ($statement->execute()) {
            echo "\nUser updation successful.\n";
        } else {
            echo "\nUser updation failed.\n";
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
        <title>Edit User</title>
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
            <input type="text" name="username" value="<?= $user->username ?>" placeholder="Change Username" />
            <br />
            <input type="email" name="email" value="<?= $user->email ?>" placeholder="Change Email" />
            <br />
            <input type="password" name="password" value="" placeholder="Change Password" />
            <br />
            <button type="submit" name="submit">Update</button>
        </form>
    </body>
</html>
