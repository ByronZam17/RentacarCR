<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Conexión a la base de datos
    $conectar = mysqli_connect('localhost', 'root', '', 'proyectoweb');

    // Verificar si la conexión es correcta
    if (!$conectar) {
        die("Error al conectar a la base de datos: " . mysqli_connect_error());
    }

    // Consulta SQL para eliminar el registro
    $sql = "DELETE FROM cedes WHERE ID = '$id'";

    if (mysqli_query($conectar, $sql)) {
        echo "Registro eliminado exitosamente";
    } else {
        echo "Error al eliminar el registro: " . mysqli_error($conectar);
    }

    // Cierra la conexión a la base de datos
    mysqli_close($conectar);
}
?>
