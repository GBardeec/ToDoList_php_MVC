<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "tasklist";

try {
    $connection = new \PDO("mysql:host=$host;dbname=$database", $username, $password);
    $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
} catch (\PDOException $e) {
    echo "Ошибка подключения к базе данных: " . $e->getMessage();
    die();
}