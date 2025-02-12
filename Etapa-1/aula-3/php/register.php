<?php

header('Content-Type: application/json');

          $username = $_POST['username'] ?? '';
          $password = $_POST['password'] ?? '';
          $email = $_POST['email'] ?? '';

          if ($username && $password && $email) {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    
                    $userData = [
                              'username' => $username,
                              'password' => $hashedPassword,
                              'email' => $email,
                              'created_at' => date('d-m-Y')
                    ];
                    
                    $jsonFile = '../db/users.json';
                    $users = [];
                    
                    if (file_exists($jsonFile)) {
                              $users = json_decode(file_get_contents($jsonFile), true) ?? [];
                    }
                    
                    $users[] = $userData;
                    
                    file_put_contents($jsonFile, json_encode($users, JSON_PRETTY_PRINT));
                    
                    echo json_encode(["status" => "success", "message" => "Usuário criado com sucesso"]);
          }
?>
