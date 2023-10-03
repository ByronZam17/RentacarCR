<?php
// Conexión a la base de datos
$conectar = mysqli_connect('localhost', 'root', '', 'proyectoweb');

// Verificar si la conexión es correcta
if (!$conectar) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}


// Procesar los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo = $_POST["tipo"];
    $Marca = $_POST["Marca"];
    $selectedExtras = $_POST["extras"];
    $cedula = $_POST["cedula"];

    // Obtener el precio del carro
    $carPriceQuery = "SELECT Precio FROM vehiculos WHERE tipo = '$tipo' AND Marca = '$Marca'";
    $carPriceResult = $conectar->query($carPriceQuery);
    $carPriceRow = $carPriceResult->fetch_assoc();
    $carPrice = $carPriceRow['Precio'];
    $selectedExtras = $_POST["extras"];
    $extrasPrice = 0;
    
    // Verificar si se han seleccionado extras
    if (!empty($selectedExtras)) {
        foreach ($selectedExtras as $extraId) {
            // Consultar el precio del extra en la base de datos
            $extrasPriceQuery = "SELECT precio FROM articulos WHERE id = '$extraId'";
            $extrasPriceResult = $conectar->query($extrasPriceQuery);
    
            if ($extrasPriceResult) {
                $extrasPriceRow = $extrasPriceResult->fetch_assoc();
                $extrasPrice += $extrasPriceRow['precio'];
            }
        }
    }
    $extrasString = implode(', ', $selectedExtras);
    
    // Calcular el precio total de la renta
    $totalPrice = $carPrice + $extrasPrice;

    // Insertar los datos en la base de datos
    $query = "INSERT INTO rental_data (tipo, Marca, extras, total_price, cedula) VALUES ('$tipo', '$Marca', '$extrasString', '$totalPrice', '$cedula')";
    if ($conectar->query($query) === TRUE) {
        echo "¡Renta realizada con éxito! Precio total: $" . number_format($totalPrice, 2);
    } else {
        echo "Error al realizar la renta: " . $conectar->error;
    }

    // Cerrar la conexión a la base de datos
    $conectar->close();
}
?>
