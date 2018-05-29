<?php

require_once 'database.php';

$id = base64_decode($_GET['key']);
$data = $_POST;
$sql = 'SELECT * FROM users WHERE id = '.$id;
$result = mysqli_query($mysqli, $sql);
if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
}
if (isset($data['submit'])) {
    $sql = 'UPDATE users SET username = "'.$data['username'].'", email = "'.$data['email'].'", password = "'.$data['password'].'" WHERE id = '.$id;
    if (!mysqli_query($mysqli, $sql)) {
        echo "User creation failed".mysqli_error($mysqli);
    }
}
mysqli_close($mysqli);

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
