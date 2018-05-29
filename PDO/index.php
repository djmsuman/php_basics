<?php

require_once 'database.php';

try {
    $sql = 'SELECT * FROM users';
    $statement = $dbh->prepare($sql);
    if ($statement->execute() && $statement->rowCount() > 0) {
        $users = $statement->fetchAll(PDO::FETCH_OBJ);
    } else {
        $users = null;
    }
    $dbh = null;
} catch(PDOException $exception) {
    echo $exception->getMessage();
    die();
}

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
                        <td><?= $user->username ?></td>
                        <td><?= $user->email ?></td>
                        <td><?= $user->password ?></td>
                        <td>
                            <a href="view.php?key=<?= base64_encode($user->id) ?>">
                                <button type="button">View</button>
                            </a>
                            <a href="edit.php?key=<?= base64_encode($user->id) ?>">
                                <button type="button">Edit</button>
                            </a>
                            <a href="delete.php?key=<?= base64_encode($user->id) ?>">
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
