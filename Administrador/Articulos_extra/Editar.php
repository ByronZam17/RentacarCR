<?php
// Obtén el ID del registro a editar (deberías validar y asegurar este valor)
$id = $_GET['id'];

// Realiza una consulta SQL para obtener los datos del registro
$conectar = mysqli_connect('localhost', 'root', '', 'proyectoweb');
$consulta = "SELECT * FROM articulos WHERE ID = '$id'";
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
            <tr>
                <td>
                    <input type="text" name="articulos" id="articulos" placeholder="articulo" value="<?php echo $datos['articulos']; ?>">
                </td>
                <td>
                    <input type="number" name="cantidad" id="cantidad" placeholder="Cantidad de articulo" value="<?php echo $datos['cantidad']; ?>">
                </td>
                <td>
                    <input type="number" name="precio" id="precio" placeholder="Precio" value="<?php echo $datos['precio']; ?>">
                </td>
                <br>
                <br>

                
                <button type="submit">Actualizar</button>
                <a href="http://localhost/DesarrolloWeb_proyecto/Administrador/Articulos_extra/extras.html">Regresar</a> 
            </form>
    </div>
</body>
</html>