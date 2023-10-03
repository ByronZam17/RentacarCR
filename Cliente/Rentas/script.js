$(document).ready(function() {
    // Evento que se dispara cuando se cambia el tipo de carro seleccionado
    $('#tipo').change(function() {
        const tipo = $(this).val();
        // Realizar una petición AJAX al servidor para obtener los modelos de carros según el tipo
        $.get('renta.php', { tipo: tipo }, function(data) {
            $('#Marca').html(data);
        });
    });
});
