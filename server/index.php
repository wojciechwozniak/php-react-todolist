<?php
require_once "TaskManager.php";

$taskManager = new TaskManager();

// Przykłady użycia
$taskManager->addTask("Zadanie 1");
$taskManager->addTask("Zadanie 2");
$taskManager->addTask("Zadanie 3");

$allTasks = $taskManager->getAllTasks();
foreach ($allTasks as $task) {
    echo "ID: " . $task->id . ", Content: " . $task->content . ", Done: " . ($task->done ? "Tak" : "Nie") . "<br>";
}

$taskIdToDelete = 2;
if ($taskManager->deleteTask($taskIdToDelete)) {
    echo "Zadanie o ID $taskIdToDelete zostało usunięte.<br>";
} else {
    echo "Nie udało się usunąć zadania o ID $taskIdToDelete.<br>";
}

$taskIdToMarkAsDone = 1;
if ($taskManager->markTaskAsDone($taskIdToMarkAsDone)) {
    echo "Zadanie o ID $taskIdToMarkAsDone zostało oznaczone jako wykonane.<br>";
} else {
    echo "Nie udało się oznaczyć zadania o ID $taskIdToMarkAsDone jako wykonane.<br>";
}
?>
