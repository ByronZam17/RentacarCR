<?php
// Obtén el ID del registro a editar (deberías validar y asegurar este valor)
$id = $_GET['id'];

// Realiza una consulta SQL para obtener los datos del registro
$conectar = mysqli_connect('localhost', 'root', '', 'proyectoweb');
$consulta = "SELECT * FROM vehiculos WHERE ID = '$id'";
$resultado = mysqli_query($conectar, $consulta);

// Verifica si la consulta se ejecutó correctamente
if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($conectar));
}

// Obtén los datos del registro
$datos = mysqli_fetch_assoc($resultado);

// Cierra la conexión a la base de datos
mysqli_close($conectar);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="http://localhost/DesarrolloWeb_proyecto/Vista/Editar.css">
    <script src="funcion_editar.js"></script>
    <title>Editar Producto</title>
</head>
<body>
<Center><h1>Editar Producto</h1>
        <div class="form">
            <form id="editar-form" action="actualizar.php" method="POST">
                <input type="hidden" id="id" name="id" value="<?php echo $id;?>">
                <label>Placa:</label>
                <input type="text" id="placa" name="placa" value="<?php echo $datos['placa']; ?>"> <br><br>
                <label>Marca:</label>
                <input type="text" id="Marca" name="Marca" value="<?php echo $datos['Marca']; ?>"> <br><br>
                <select name="tipo" id="tipo" value="<?php echo $datos['tipo']; ?>">
                    <option value="todoterreno">todoterreno</option>
                    <option value="familiar">familiar</option>
                    <option value="deportivo">deportivo</option>
                    <option value="estandar">estandar</option>
                </select>
                <br><br>
                <label>Anio:</label>
                <input type="number" id="anio" name="anio" min="1900" max="<?php echo date('Y'); ?>" value="<?php echo $datos['anio']; ?>" > <br><br>
                <label>Precio:</label>
                <input type="number" id="Precio" name="Precio" value="<?php echo $datos['Precio']; ?>"> <br><br>

                
                <button type="submit">Actualizar</button>
                <a href="http://localhost/DesarrolloWeb_proyecto/Administrador/vehiculos/vehiculos.html">Regresar</a> 
            </form>
    </div>
</body>
</html>