<?php

require_once 'Database.php';

class UserModel
{
    private $connection;

    public function __construct()
    {
        $database = Database::getInstance();
        $this->connection = $database->getConnection();
    }

    public function checkUserExists($username)
    {
        $stmt = $this->connection->prepare("SELECT id FROM users WHERE login = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch();

        return ($user !== false);
    }

    public function login($username, $password)
    {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE login = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
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

        $loggedIn = $this->login($username, $password);

        if ($loggedIn) {
            return true;
        } else {
            return false;
        }
    }
}