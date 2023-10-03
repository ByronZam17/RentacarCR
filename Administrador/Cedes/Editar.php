<?php
// Obtén el ID del registro a editar (deberías validar y asegurar este valor)
$id = $_GET['id'];

// Realiza una consulta SQL para obtener los datos del registro
$conectar = mysqli_connect('localhost', 'root', '', 'proyectoweb');
$consulta = "SELECT * FROM cedes WHERE ID = '$id'";
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
            <td>
                    <select name="provincia" id="provincia" value="<?php echo $datos['provincia']; ?>">
                        <option value="San Jose">San Jose</option>
                        <option value="Cartago">Cartago</option>
                        <option value="Heredia">Heredia</option>
                        <option value="Alajuela">Alajuela</option>
                        <option value="Limon">Limon</option>
                        <option value="Guanacaste">Guanacaste</option>
                    </select>
                </td>
                <br>
                <br>
                <td>
                    <input type="number" name="personal" id="personal"  value="<?php echo $datos['personal']; ?>"> 
                </td>
                <br>
                <td>
                    <select name="disposicion" id="disposicion"  value="<?php echo $datos['disposicion']; ?>">
                        <option value="Abierta">Abierta</option>
                        <option value="Mantenimiento">Mantenimiento</option>
                    </select>
                </td>
                <br>
                <br>
                <td>
                    <input type="text" name="direccion" id="direccion"  value="<?php echo $datos['direccion']; ?>">
                </td>
                <td>
                <br>
                <br>

                
                <button type="submit">Actualizar</button>
                <a href="http://localhost/DesarrolloWeb_proyecto/Administrador/Cedes/Cedes.html">Regresar</a> 
            </form>
    </div>
</body>
</html>