<?php

require_once 'database.php';

$id = base64_decode($_GET['key']);
$data = $_POST;
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
if (isset($data['submit'])) {
    $sql = 'UPDATE users SET username = ?, email = ?, password = ? WHERE id = '.$id;
    $statement = $mysqli->prepare($sql);
    $statement->bind_param("sss", $username, $email, $password);
    $username = $data['username'];
    $email = $data['email'];
    $password = md5($data['password']);
    $statement->execute();
    $statement->close();
    $mysqli->close();
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
            <input type="text" name="username" value="<?= $user['username'] ?>" placeholder="Change Username" />
            <br />
            <input type="email" name="email" value="<?= $user['email'] ?>" placeholder="Change Email" />
            <br />
            <input type="password" name="password" value="" placeholder="Change Password" />
            <br />
            <button type="submit" name="submit">Update</button>
        </form>
    </body>
</html>
