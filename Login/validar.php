<?php
session_start();

$conectar = mysqli_connect('localhost', 'root', '', 'proyectoweb');

if (!$conectar) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["usuario"];
    $password = $_POST["password"];

    $sql = "SELECT rol FROM usuarios WHERE usuario = ? AND password = ?";
    $stmt = $conectar->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->bind_result($userRole);

    if ($stmt->fetch()) {
        header("Content-Type: application/json");
        echo json_encode(["role" => ($userRole == 1) ? 'admin' : 'user']);
    } else {
        http_response_code(401);
    }
    
    $stmt->close();
}

$conectar->close();
?>
