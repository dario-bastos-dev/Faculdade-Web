<?php
header('Content-Type: application/json');

class TaskManager {
          private $jsonFile = '../db/tasks.json';

          public function __construct() {
                    if (!file_exists($this->jsonFile)) {
                              file_put_contents($this->jsonFile, json_encode([]));
                    }
          }

          public function addTask($title, $description) {
                    try {
                              $title = trim($title);
                              $description = trim($description);
                              
                              if (empty($title)) {
                                        throw new Exception('Title cannot be empty');
                              }
                              if (empty($description)) {
                                        throw new Exception('Description cannot be empty');
                              }

                              $tasks = $this->getAllTasks();
                              
                              $newTask = [
                                        'id' => uniqid(),
                                        'title' => $title,
                                        'description' => $description,
                                        'created_at' => date('Y-m-d H:i:s')
                              ];

                              $tasks[] = $newTask;
                              file_put_contents($this->jsonFile, json_encode($tasks, JSON_PRETTY_PRINT));
                              
                              return ['status' => 'success', 'data' => $newTask];
                    } catch (Exception $e) {
                              return ['status' => 'error', 'message' => $e->getMessage()];
                    }
          }

          public function getAllTasks() {
                    try {
                              $content = file_get_contents($this->jsonFile);
                              $tasks = json_decode($content, true) ?? [];
                              return $tasks;
                    } catch (Exception $e) {
                              return ['status' => 'error', 'message' => $e->getMessage()];
                    }
          }
}

$taskManager = new TaskManager();

switch ($_SERVER['REQUEST_METHOD']) {
          case 'POST':
                    $response = $taskManager->addTask($_POST['title'] ?? '', $_POST['description'] ?? '');
                    http_response_code($response['status'] === 'success' ? 201 : 400);
                    echo json_encode($response);
                    break;

          case 'GET':
                    $response = $taskManager->getAllTasks();
                    echo json_encode(['status' => 'error', 'data' => $response]);
                    break;

          default:
                    http_response_code(405);
                    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
                    break;
}