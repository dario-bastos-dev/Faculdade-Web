<?php
header('Content-Type: application/json');

function getAllUsers() {
          $filePath = '../db/users.json';

          if (!file_exists($filePath)) {
                    http_response_code(404);
                    echo json_encode(['error' => 'File not found']);
                    return;
          }

          $jsonContent = file_get_contents($filePath);
          $users = json_decode($jsonContent, true);

          if ($users === null) {
                    http_response_code(500);
                    echo json_encode(['error' => 'Error decoding JSON']);
                    return;
          }

          http_response_code(200);
          echo json_encode($users);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
          getAllUsers();
} else {
          http_response_code(405);
          echo json_encode(['error' => 'Method not allowed']);
}
?>