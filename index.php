<?php
session_start();

require_once 'Router.php';

function customAutoload($className) {
    $classFile = 'MVC/models/' . $className . '.php';
    if (file_exists($classFile)) {
        require_once $classFile;
    }
}

spl_autoload_register('customAutoload');

$router = new Router();
$router->route();