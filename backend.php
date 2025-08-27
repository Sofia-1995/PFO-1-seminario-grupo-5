<?php
header("Content-Type: application/json; charset=UTF-8");

// i) Recibir los datos enviados por frontend
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(["status" => "error", "message" => "No se recibieron datos"]);
    exit;
}

// ii) Verificación backend
$nombre     = trim($data["nombre"] ?? "");
$email      = trim($data["email"] ?? "");
$username   = trim($data["username"] ?? "");
$password   = trim($data["password"] ?? "");
$confirm    = trim($data["confirm_password"] ?? "");

// Validaciones
if ($nombre === "" || $email === "" || $username === "" || $password === "" || $confirm === "") {
    echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios"]);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["status" => "error", "message" => "El email no es válido"]);
    exit;
}

if ($password !== $confirm) {
    echo json_encode(["status" => "error", "message" => "Las contraseñas no coinciden"]);
    exit;
}

// Acá podrías guardar en base de datos (ejemplo: MySQL)
// En este ejemplo solo devolvemos éxito

// iii) Devolver respuesta al frontend
echo json_encode([
    "status"  => "ok",
    "message" => "Usuario registrado correctamente",
    "data"    => [
        "nombre" => $nombre,
        "email"  => $email,
        "username" => $username
    ]
]);
