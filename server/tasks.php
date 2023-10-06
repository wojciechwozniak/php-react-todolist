<?php
require_once "TaskManager.php";

$taskManager = new TaskManager();
// Ustalenie źródła, które będzie miało dostęp do zasobów (w przypadku developmentu możesz użyć "*")
$allowOrigin = "*";

// Ustalenie dozwolonych metod HTTP
$allowMethods = "GET, POST, PUT, DELETE, PATCH";

// Ustawienie nagłówków CORS
header("Access-Control-Allow-Origin: $allowOrigin");
header("Access-Control-Allow-Methods: $allowMethods");
header("Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token");
// Obsługa metod HTTP
$method = $_SERVER["REQUEST_METHOD"];
switch ($method) {
    case "OPTIONS":
        header("HTTP/1.1 200 OK");
        break;
    case "GET":
        // Pobierz listę zadań
        $tasks = $taskManager->getAllTasks();
        http_response_code(200);
        echo json_encode($tasks);
        break;
    case "POST":
        // Dodawanie nowego zadania
        $data = json_decode(file_get_contents("php://input"), true);
        if ($data && isset($data["content"])) {
            $newTask = $taskManager->addTask($data["content"]);
            http_response_code(201);
            echo json_encode($newTask);
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Nieprawidłowe dane"]);
        }
        break;
    case "DELETE":
        // Usuwanie zadania
        $taskId = $_GET["id"];
        if ($taskManager->deleteTask($taskId)) {
            http_response_code(204);
        } else {
            http_response_code(404);
            echo json_encode(["error" => "Zadanie nie zostało znalezione"]);
        }
        break;
    case "PATCH":
        // Aktualizacja zadania (oznaczenie jako wykonane)
        $taskId = $_GET["id"];
        if ($taskManager->markTaskAsDone($taskId)) {
            http_response_code(200);
        } else {
            http_response_code(404);
            echo json_encode(["error" => "Zadanie nie zostało znalezione"]);
        }
        break;
    default:
        http_response_code(405);
        echo json_encode(["error" => "Nieobsługiwana metoda HTTP"]);
        break;
}

