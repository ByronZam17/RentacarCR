<?php
// Conexión a la base de datos
$conectar = mysqli_connect('localhost', 'root', '', 'proyectoweb');

// Verificar si la conexión es correcta
if (!$conectar) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

// Conexión a la base de datos (como se mostró en respuestas anteriores)

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $cedula = $_GET["cedula"];
    
    // Consultar la renta asociada a la cédula
    $query = "SELECT * FROM rental_data WHERE cedula = '$cedula'";
    $result = $conectar->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<h2>Información de la Renta</h2>";
        echo "<p>ID de Renta: " . $row["id"] . "</p>";
        echo "<p>Tipo de Carro: " . $row["tipo"] . "</p>";
        echo "<p>Modelo: " . $row["Marca"] . "</p>";
        echo "<p>Extras: " . $row["extras"] . "</p>";
        echo "<p>Precio Total: $" . $row["total_price"] . "</p>";
        echo "<p>Estado: " . $row["estado"] . "</p>";

        // Agregar un formulario para cambiar el estado de la renta
        echo "<form id='cambiarEstadoForm'>";
        echo "<input type='hidden' id='rentaId' name='rentaId' value='" . $row["id"] . "'>";
        echo "<div class='form-group'>";
        echo "<label for='nuevoEstado'>Cambiar Estado:</label>";
        echo "<select class='form-control' id='nuevoEstado' name='nuevoEstado'>";
        echo "<option value='activa'>Activa</option>";
        echo "<option value='cancelada'>Cancelada</option>";
        echo "</select>";
        echo "</div>";
        echo "<button type='submit' class='btn btn-primary'>Guardar Cambio</button>";
        echo "</form>";
        echo "<p id='mensajeEstado'></p>";
    } else {
        echo "No se encontró ninguna renta asociada a la cédula.";
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rentaId = $_POST["rentaId"];
    $nuevoEstado = $_POST["nuevoEstado"];

    // Actualizar el estado de la renta en la base de datos
    $updateQuery = "UPDATE rental_data SET estado = '$nuevoEstado' WHERE id = $rentaId";
    if ($conectar->query($updateQuery) === TRUE) {
        echo "Estado actualizado con éxito.";
    } else {
        echo "Error al actualizar el estado: " . $conectar->error;
    }
}

// Cerrar la conexión a la base de datos
$conectar->close();
?>
