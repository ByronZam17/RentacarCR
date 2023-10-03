<?php
// Conexión a la base de datos
$conectar = mysqli_connect('localhost', 'root', '', 'proyectoweb');

// Verificar si la conexión es correcta
if (!$conectar) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

// Obtener el tipo de carro enviado desde la petición AJAX
$tipo = $_GET['tipo'];

// Consultar los modelos de carros según el tipo
$query = "SELECT Marca FROM vehiculos WHERE tipo = '$tipo'";
$result = $conectar->query($query);

// Generar las opciones de modelos de carros
$options = '<option value="">Selecciona un modelo</option>';
while ($row = $result->fetch_assoc()) {
    $options .= '<option value="' . $row['Marca'] . '">' . $row['Marca'] . '</option>';
}

// Imprimir las opciones generadas
echo $options;

// Cerrar la conexión a la base de datos
$conectar->close();
?>
