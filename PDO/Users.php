<?php

require_once 'database.php';

/**
 * Users
 */
class Users extends dbConnect
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * Set username.
     * @param string $username
     * @return Users
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Get username.
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set email.
     * @param string $email
     * @return Users
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get email.
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password.
     * @param string $password
     * @return Users
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Get password.
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    public function save() {
        $sql = 'INSERT INTO users (username, email, password) VALUES (:username, :email, :password)';
        $statement = $this->dbh->prepare($sql);
        $statement->bindParam(':username', $this->username);
        $statement->bindParam(':email', $this->email);
        $statement->bindParam(':password', $this->password);
        $statement->execute();
        $dbh = null;
    }

    public function fetchAll() {
        $sql = 'SELECT * FROM users';
        $statement = $this->dbh->prepare($sql);
        if ($statement->execute() && $statement->rowCount() > 0) {
            $users = $statement->fetchAll(PDO::FETCH_OBJ);
        } else {
            $users = null;
        }
        $dbh = null;
    }
}
