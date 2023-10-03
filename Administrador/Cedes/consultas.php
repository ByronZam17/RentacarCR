<?php
// Conexión a la base de datos
$conectar = mysqli_connect('localhost', 'root', '', 'proyectoweb');

// Verificar si la conexión es correcta
if (!$conectar) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $provincia = $_POST["provincia"];
    $personal = $_POST["personal"];
    $disposicion = $_POST["disposicion"];
    $direccion = $_POST["direccion"];


    // Consulta SQL para insertar el vehículo en la base de datos
    $sql = "INSERT INTO cedes (provincia, personal, disposicion, direccion) VALUES ('$provincia', '$personal', '$disposicion', '$direccion')";

    if (mysqli_query($conectar, $sql)) {
        header("location: http://localhost/DesarrolloWeb_proyecto/Administrador/Cedes/Cedes.html");
        exit(); // Terminar el script después de redirigir
    } else {
        echo "Error al guardar los datos: " . mysqli_error($conectar);
    }
}


$conexion = new mysqli("localhost", "root", "", "proyectoweb");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$query = "SELECT * FROM cedes";
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




