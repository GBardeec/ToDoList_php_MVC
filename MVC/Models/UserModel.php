<?php

require_once 'database.php';

class UserModel
{
    private $connection;

    public function __construct()
    {
        global $connection;
        $this->connection = $connection;
    }

    public function login($username, $password)
    {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE login = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['id'] = $user['id'];
            $_SESSION['login'] = $user['login'];
            return true;
        }

        return false;
    }

    public function registerAndLogin($username, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $created_at = date('Y-m-d H:i:s');

        $sql = "INSERT INTO users (login, password, created_at) VALUES (?, ?, ?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$username, $hashedPassword, $created_at]);

        $id = $this->connection->lastInsertId();

        $loggedIn = $this->login($username, $password);

        if ($loggedIn) {
            session_start();
            $_SESSION['login'] = $username;
            return true;
        } else {
            $sqlDelete = "DELETE FROM users WHERE id = ?";
            $stmtDelete = $this->connection->prepare($sqlDelete);
            $stmtDelete->execute([$id]);

            return false;
        }
    }
}