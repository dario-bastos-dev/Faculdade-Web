<?php

header('Content-Type: application/json');

          $username = $_POST['username'] ?? '';
          $password = $_POST['password'] ?? '';

          $valid_username = "admin";
          $valid_password = "123456";

          if ($username === $valid_username && $password === $valid_password) {
                    echo json_encode(["status" => "success", "message" => "Usuário logado com sucesso"]);
          } else {
                    echo json_encode(["status" => "error", "message" => "Usuário ou senha inválidos"]);
          }
?>