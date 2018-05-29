<?php

require_once 'database.php';

$sql = 'SELECT * FROM users';
if ($statement = $mysqli->prepare($sql)) {
    $statement->execute();
    $statement->bind_result($id, $username, $email, $password);
    $key == 0;
    while ($statement->fetch()) {
        $users[$key]['id'] = $id;
        $users[$key]['username'] = $username;
        $users[$key]['email'] = $email;
        $users[$key++]['password'] = $password;
    }
    $statement->close();
}
$mysqli->close();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>List Users</title>
        <style>
            table, thead, tbody, tfoot, tr, th, td {
                border: 1px solid #000;
                border-collapse: collapse;
                padding: 5px 10px 5px 10px;
            }
            button {
                border: 1px solid #000;
                border-collapse: separate;
                padding: 5px;
            }
            a { text-decoration: none; }
        </style>
    </head>
    <body>
        <a href="new.php">
            <button type="button">New</button>
        </a>
        <br />
        <br />
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $key => $user) { ?>
                    <tr>
                        <td><?= ++$key ?></td>
                        <td><?= $user['username'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['password'] ?></td>
                        <td>
                            <a href="view.php?key=<?= base64_encode($user['id']) ?>">
                                <button type="button">View</button>
                            </a>
                            <a href="edit.php?key=<?= base64_encode($user['id']) ?>">
                                <button type="button">Edit</button>
                            </a>
                            <a href="delete.php?key=<?= base64_encode($user['id']) ?>">
                                <button type="button">Delete</button>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
    </body>
</html>
