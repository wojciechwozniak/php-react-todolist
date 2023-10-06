<?php
require_once "../TaskManager.php";

use PHPUnit\Framework\TestCase;

class TaskManagerTest extends TestCase
{
    public function testTaskManagerAddTask()
    {
        $taskManager = new TaskManager();
        $newTask = $taskManager->addTask("Nowe zadanie");
        $this->assertEquals("Nowe zadanie", $newTask->content);
    }

    public function testTaskManagerDeleteTask()
    {
        $taskManager = new TaskManager();
        $taskIdToDelete = 1; // Załóżmy, że istnieje zadanie o ID 1
        $result = $taskManager->deleteTask($taskIdToDelete);
        $this->assertTrue($result);
    }

    public function testTaskManagerMarkTaskAsDone()
    {
        $taskManager = new TaskManager();
        $taskIdToMarkAsDone = 1; // Załóżmy, że istnieje zadanie o ID 1
        $result = $taskManager->markTaskAsDone($taskIdToMarkAsDone);
        $this->assertTrue($result);
    }
}

?>
