<?php
$conexion = new mysqli("localhost", "root", "", "proyectoweb");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$query = "SELECT * FROM vehiculos";
$result = mysqli_query($conexion, $query);
if (!$result) {
    die('Query Failed' . mysqli_error($conexion)); // Aquí debería ser $conexion, no $connection
}

$listaDeResultados = array();

while ($row = mysqli_fetch_assoc($result)) {
    $listaDeResultados[] = $row;
}

header("Content-Type: application/json");
echo json_encode($listaDeResultados);

$conexion->close();

?>