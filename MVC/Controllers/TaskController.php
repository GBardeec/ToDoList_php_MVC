<?php
require_once 'MVC/models/TaskModel.php';

class TaskController
{
    private $model;

    public function __construct()
    {
        $this->model = new TaskModel();
    }

    public function addTask($description)
    {
        $user_id = (integer) $_SESSION['id'];
        $created_at = date('Y-m-d H:i:s');
        $this->model->addTask($user_id, $description, $created_at);
        header('Location: /');
    }

    public function getTasksWithStatusNull()
    {
        $user_id = (integer) $_SESSION['id'];
        $result = $this->model->getTasksWithStatusNull($user_id);
        return $result;
    }

    public function getTasksWithStatusNotNull()
    {
        $user_id = (integer) $_SESSION['id'];
        $result = $this->model->getTasksWithStatusNotNull($user_id);
        return $result;
    }

    public function deleteAllTask()
    {
        $user_id = (integer) $_SESSION['id'];
        $this->model->deleteAllTask($user_id);
        header('Location: /');
    }

    public function changeStatusAllTask()
    {
        $user_id = (integer) $_SESSION['id'];
        $this->model->changeStatusAllTask($user_id);
        header('Location: /');
    }

    public function deleteOneTask($taskId)
    {
        $this->model->deleteOneTask($taskId);
        header('Location: /');
    }

    public function toggleStatus($taskId)
    {
        $this->model->toggleStatus($taskId);
        header('Location: /');
    }

    public function changeBackGroundColor($row)
    {
        $statusClass = '';
        if ($row['status'] == 'ready') {
            $statusClass = 'list-group-item-success';
        } else if ($row['status'] == 'unready') {
            $statusClass = 'list-group-item-danger';
        }
        return $statusClass;
    }
}
?>