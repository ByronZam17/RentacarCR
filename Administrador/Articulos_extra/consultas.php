<?php
// Conexión a la base de datos
$conectar = mysqli_connect('localhost', 'root', '', 'proyectoweb');

// Verificar si la conexión es correcta
if (!$conectar) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $articulos = $_POST["articulos"];
    $cantidad = $_POST["cantidad"];
    $precio = $_POST["precio"];



        // Consulta SQL para insertar el vehículo en la base de datos
        $sql = "INSERT INTO articulos (articulos, cantidad, precio) VALUES ('$articulos', '$cantidad', '$precio')";

    if (mysqli_query($conectar, $sql)) {
        header("location: http://localhost/DesarrolloWeb_proyecto/Administrador/Articulos_extra/extras.html");
        exit(); // Terminar el script después de redirigir
    } else {
        echo "Error al guardar los datos: " . mysqli_error($conectar);
    }
}

$conexion = new mysqli("localhost", "root", "", "proyectoweb");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$query = "SELECT * FROM articulos";
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




