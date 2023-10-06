<?php
require_once "../Task.php";

use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase
{
    public function testTaskCreation()
    {
        $task = new Task(1, "Testowe zadanie", false);
        $this->assertEquals(1, $task->id);
        $this->assertEquals("Testowe zadanie", $task->content);
        $this->assertFalse($task->done);
    }
}

?>
