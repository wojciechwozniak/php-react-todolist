<?php
require_once "Task.php";

class TaskManager
{
    private $tasks = [];
    private $dbFile = "tasks.json"; // Nazwa pliku bazy danych

    public function __construct()
    {
        // Inicjalizacja bazy danych
        $this->loadTasks();
    }

    public function getAllTasks()
    {
        return $this->tasks;
    }

    public function addTask($content)
    {
        $newTask = new Task(count($this->tasks) + 1, $content, false);
        $this->tasks[] = $newTask;
        $this->saveTasks();
        return $newTask;
    }

    public function deleteTask($id)
    {
        foreach ($this->tasks as $key => $task) {
            if ($task->id == $id) {
                array_splice($this->tasks, $key, 1);
                $this->saveTasks();
                return true;
            }
        }
        return false;
    }

    public function markTaskAsDone($id)
    {
        foreach ($this->tasks as $task) {
            if ($task->id == $id) {
                $task->done = true;
                $this->saveTasks();
                return true;
            }
        }
        return false;
    }

    private function loadTasks()
    {
        if (file_exists($this->dbFile)) {
            $data = json_decode(file_get_contents($this->dbFile), true);
            foreach ($data as $taskData) {
                $task = new Task($taskData["id"], $taskData["content"], $taskData["done"]);
                $this->tasks[] = $task;
            }
        }
    }

    private function saveTasks()
    {
        $data = [];
        foreach ($this->tasks as $task) {
            $data[] = [
                "id" => $task->id,
                "content" => $task->content,
                "done" => $task->done
            ];
        }
        file_put_contents($this->dbFile, json_encode($data, JSON_PRETTY_PRINT));
    }
}
?>
