<?php

header('Content-Type: application/json');

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Read the JSON file containing user credentials
$users_json = file_get_contents('db/users.json');
$users = json_decode($users_json, true);

$valid_login = false;

// Check if the submitted credentials match any user in the JSON file
$valid_email = '';
$valid_password = '';

foreach ($users as $user) {
          if ($email === $user['email']) {
                    $valid_email = $user['email'];
                    // Verify if the submitted password matches the hashed password
                    if (password_verify($password, $user['password'])) {
                                          $valid_login = true;
                                          $valid_password = $user['password'];
                                          break;
                    }
  }
}

if (!$valid_email) {
echo json_encode(["status" => "error", "message" => "E-mail não encontrado"]);
return;
}

if ($valid_login) {
echo json_encode(["status" => "success", "message" => "Usuário logado com sucesso"]);
} else {
echo json_encode(["status" => "error", "message" => "Senha incorreta"]);
}
?>