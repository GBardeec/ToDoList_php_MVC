<?php
session_start();
require_once 'router.php';
require_once 'MVC/Controllers/UserController.php';
require_once 'MVC/Controllers/TaskController.php';

$router = new Router();
$router->route();