<?php

class Router
{
    private $routes = array(
        '' => 'IndexController@index',

        'login' => 'UserController@login',
        'logout' => 'UserController@logout',

        'addTask' => 'TaskController@addTask',
        'deleteAllTask' => 'TaskController@deleteAllTask',
        'changeStatusAllTask' => 'TaskController@changeStatusAllTask',
        'deleteOneTask' => 'TaskController@deleteOneTask',
        'toggleStatus' => 'TaskController@toggleStatus',
    );

    public function route()
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = trim($url, '/');
        $url = explode('?', $url)[0];

        foreach ($this->routes as $route => $action) {
            if ($url === $route) {
                $routeAction = explode('@', $action);
                $controllerName = ucfirst($routeAction[0]);
                $methodName = $routeAction[1];

                require_once 'MVC/Controllers/' . $controllerName . '.php';

                $controller = new $controllerName();
                $methodParameters = [];

                if ($methodName === 'addTask') {
                    $description = $_POST['description'];
                    $methodParameters[] = $description;
                } else if ($methodName === 'deleteOneTask') {
                    $taskId = $_POST['taskId'];
                    $methodParameters[] = $taskId;
                } else if ($methodName === 'toggleStatus') {
                    $taskId = $_POST['taskId'];
                    $methodParameters[] = $taskId;
                }

                call_user_func_array([$controller, $methodName], $methodParameters);
                return;
            }
        }
        echo 'Страница не найдена';
    }
}