<?php
// Obtén los datos del formulario (suponiendo que los datos se envían a través de POST)
$id = $_POST['id'];
$provincia = $_POST["provincia"];
$personal = $_POST["personal"];
$disposicion = $_POST["disposicion"];
$direccion = $_POST["direccion"];


// Conexión a la base de datos
$conectar = mysqli_connect('localhost', 'root', '', 'proyectoweb');

// Verificar si la conexión es correcta
if (!$conectar) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

// Consulta SQL para actualizar los datos del producto
$sql = "UPDATE Cedes SET provincia='".$provincia."', personal='".$personal."', disposicion='".$disposicion."', direccion='".$direccion."' WHERE Id='".$id."'";

if ($conectar->query($sql) === TRUE) {
    // La actualización se realizó correctamente
    header("location: http://localhost/DesarrolloWeb_proyecto/Administrador/Cedes/Cedes.html");

} else {
    // Hubo un error en la actualización
    echo "Error al actualizar el producto: " . $conectar->error;
}

// Cierra la conexión a la base de datos
$conectar->close();
?>