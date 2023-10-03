<?php
// Conexión a la base de datos
$conectar = mysqli_connect('localhost', 'root', '', 'proyectoweb');

// Verificar si la conexión es correcta
if (!$conectar) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="http://localhost/DesarrolloWeb_proyecto/Vista/renta.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="script.js"></script>
    <title>Renta de Carros</title>
    <!-- Agregar enlaces a los archivos CSS de Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Renta de Carros</h1>
        <form action="procesar_renta.php" method="post">
            <div class="form-group">
                <label for="cedula">Número de Cédula:</label>
                <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Ingrese la cédula">
            </div>            
            <div class="form-group" >
                <label for="tipo">Selecciona el tipo de carro:</label>
                <select class="form-control" id="tipo" name="tipo">
                    <option value="todorerreno">todorerreno</option>
                    <option value="familiar">familiar</option>
                    <option value="deportivo">deportivo</option>
                    <option value="estandar">estandar</option>
                </select>
            </div>
            <div class="form-group">
                <label for="car_model">Selecciona el modelo de carro:</label>
                <!-- Aquí se generará dinámicamente la lista de modelos de acuerdo al tipo de carro seleccionado -->
                <select class="form-control" id="Marca" name="Marca"></select>
                <div class="form-group">
                    <label for="extras">Equipamiento Extra:</label>
                    <?php
                    // Consulta para obtener los artículos disponibles
                    $extrasQuery = "SELECT id, articulos, precio FROM articulos";
                    $extrasResult = $conectar->query($extrasQuery);

                    while ($row = $extrasResult->fetch_assoc()) {
                    $id = $row['id'];
                    $nombre = $row['articulos'];
                    $precio = $row['precio'];
                    echo "<div class='form-check'>
                        <input class='form-check-input' type='checkbox' id='extra$id' name='extras[]' value='$id'>
                        <label class='form-check-label' for='extra$id'>$nombre - $precio$</label>
                        </div>";
                    }
                    ?>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Realizar Renta</button>
            <a href="http://localhost/DesarrolloWeb_proyecto/Cliente/Historial/rentas.html" class="btn btn-warning">Mis rentas</a>
            <a href="http://localhost/DesarrolloWeb_proyecto/Cliente/Historial/rentas.html" class="btn btn-danger">Salir</a>
        </form>
        <div class="mt-3">
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
