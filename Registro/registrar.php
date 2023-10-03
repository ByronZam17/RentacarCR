<?php
// Verificar si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $usuario = $_POST["usuario"];
    $password = $_POST["password"];
    $tipo = $_POST["tipo"];


    // Conexión a la base de datos
    $conectar = mysqli_connect('localhost', 'root', '', 'proyectoweb');

    // Verificar si la conexión es correcta
    if (!$conectar) {
        die("Error al conectar a la base de datos: " . mysqli_connect_error());
    }

    // Consulta preparada
    $sql = "INSERT INTO usuarios (usuario, password, rol) VALUES ('$usuario', '$password', '$tipo')";

    // Ejecutar la consulta
    if ($conectar->query($sql) === TRUE) {
        echo "Datos insertados correctamente";
        header("location: funcion.js");
    } else {
        echo "Error al insertar datos: " . $conectar->error;
    }
}else{
    echo("no se pudo realizar el proceso");
}
?>





