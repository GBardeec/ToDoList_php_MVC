<?php

class Database
{
    private static $instance = null;
    private $connection;

    private function __construct()
    {
        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "tasklist";

        $this->connection = new \PDO("mysql:host=$host;dbname=$database", $username, $password);
        $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
