<?php

class IndexController
{
    public function index()
    {
        $taskController = new TaskController();
        require_once 'MVC/Views/IndexView.php';
    }

}