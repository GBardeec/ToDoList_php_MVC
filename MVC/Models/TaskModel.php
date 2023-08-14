<?php

require_once 'database.php';

class TaskModel
{
    private $connection;

    public function __construct()
    {
        global $connection;
        $this->connection = $connection;
    }

    public function addTask($user_id, $description, $created_at)
    {
        $sql = "INSERT INTO tasks (user_id, description, created_at) VALUES (?, ?, ?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$user_id, $description, $created_at]);
    }

    public function getTasksWithStatusNull($userId)
    {
        $queryStatusNull = "SELECT description,status FROM tasks WHERE status IS NULL AND user_id = :user_id";
        $stmtStatusNull = $this->connection->prepare($queryStatusNull);
        $stmtStatusNull->bindParam(':user_id', $userId);
        $stmtStatusNull->execute();
        $resultStatusNull = $stmtStatusNull->fetchAll(PDO::FETCH_ASSOC);

        return $resultStatusNull;
    }

    public function getTasksWithStatusNotNull($userId)
    {
        $queryStatusNotNull = "SELECT id,description,status FROM tasks WHERE status IS NOT NULL AND user_id = :user_id";
        $stmtStatusNotNull = $this->connection->prepare($queryStatusNotNull);
        $stmtStatusNotNull->bindParam(':user_id', $userId);
        $stmtStatusNotNull->execute();
        $resultStatusNotNull = $stmtStatusNotNull->fetchAll(PDO::FETCH_ASSOC);

        return $resultStatusNotNull;
    }

    public function deleteAllTask($userId)
    {
        $sql = "DELETE FROM tasks WHERE status IS NULL AND user_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$userId]);
    }

    public function changeStatusAllTask($userId)
    {
        $sql = "UPDATE tasks SET status = 'unready' WHERE status IS NULL AND user_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$userId]);
    }

    public function deleteOneTask($taskId)
    {
        $sql = "DELETE FROM tasks WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$taskId]);
    }

    public function toggleStatus($taskId)
    {
        $sql = "SELECT status FROM tasks WHERE id = ? AND user_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$taskId, $_SESSION['id']]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $currentStatus = $row['status'];

        if ($currentStatus == 'unready') {
            $newStatus = 'ready';
        } else {
            $newStatus = 'unready';
        }

        $sql = "UPDATE tasks SET status = ? WHERE id = ? AND user_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$newStatus, $taskId, $_SESSION['id']]);
    }
}

