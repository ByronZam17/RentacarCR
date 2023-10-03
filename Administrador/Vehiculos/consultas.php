<?php
// Conexión a la base de datos
$conectar = mysqli_connect('localhost', 'root', '', 'proyectoweb');

// Verificar si la conexión es correcta
if (!$conectar) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $placa = $_POST["placa"];
    $marca = $_POST["marca"];
    $anio = $_POST["anio"];
    $tipo = $_POST["tipo"];
    $Precio = $_POST["precio"]; // Asegúrate que el nombre coincida con el campo del formulario

    // Ruta donde se almacenarán las imágenes
    $targetDir = "C:/xampp/htdocs/DesarrolloWeb_proyecto/imagenes/";

    $fileName = basename($_FILES["imagen"]["name"]);
    $targetFile = $targetDir . $fileName;

    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $targetFile)) {
        // La imagen se ha guardado correctamente en la carpeta y se construye la URL
        $imagePath = "http://localhost/DesarrolloWeb_proyecto/imagenes/" . $fileName;

        // Consulta SQL para insertar el vehículo en la base de datos
        $sql = "INSERT INTO vehiculos (placa, marca, anio, tipo, Precio, imagen) VALUES ('$placa', '$marca', '$anio', '$tipo', '$Precio', '$imagePath')";

        if (mysqli_query($conectar, $sql)) {
            header("location: http://localhost/DesarrolloWeb_proyecto/Administrador/Vehiculos/vehiculos.html");
            exit(); // Terminar el script después de redirigir
        } else {
            echo "Error al guardar los datos: " . mysqli_error($conectar);
        }
    } else {
        echo "Error al guardar la imagen.";
    }
}

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




