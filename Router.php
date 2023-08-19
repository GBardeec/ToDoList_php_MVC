<?php

class Router
{
    private $routes = array(
     '' => array('controller' => 'IndexController', 'method' => 'index'),

     'login' => array('controller' => 'UserController', 'method' => 'login'),
     'logout' => array('controller' => 'UserController', 'method' => 'logout'),

     'addTask' => array('controller' => 'TaskController', 'method' => 'addTask'),
     'deleteAllTask' => array('controller' => 'TaskController', 'method' => 'deleteAllTask'),
     'changeStatusAllTask' => array('controller' => 'TaskController', 'method' => 'changeStatusAllTask'),
     'deleteOneTask' => array('controller' => 'TaskController', 'method' => 'deleteOneTask'),
     'toggleStatus' => array('controller' => 'TaskController', 'method' => 'toggleStatus'),
    );

    public function route()
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = trim($url, '/');
        $url = explode('?', $url)[0];

        if (array_key_exists($url, $this->routes)) {
            $routeInfo = $this->routes[$url];
            $controllerName = ucfirst($routeInfo['controller']);
            $methodName = $routeInfo['method'];

            // Замените подключение контроллера на автозагрузку
            $controller = new $controllerName();

            $urlParts = explode('/', $url);
            $methodParameters = array_slice($urlParts, 2);

            $controller->$methodName(...$methodParameters);
        } else {
            echo 'Страница не найдена';
        }
    }
}

spl_autoload_register(function ($className) {
    $filePath = __DIR__ . '/MVC/Controllers/' . $className . '.php';
    if (file_exists($filePath)) {
        require_once $filePath;
    }
});

