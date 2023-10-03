$(document).ready(function() {
    $('#buscarRentaForm').submit(function(event) {
        event.preventDefault();
        const cedula = $('#cedula').val();
        
        // Realizar una petición AJAX al servidor para obtener la información de la renta
        $.get('Historial.php', { cedula: cedula }, function(data) {
            $('#resultadoRenta').html(data);
            
            // Agregar evento al formulario de cambio de estado
            $('#cambiarEstadoForm').submit(function(event) {
                event.preventDefault();
                const rentaId = $('#rentaId').val();
                const nuevoEstado = $('#nuevoEstado').val();
                
                // Realizar una petición AJAX para actualizar el estado de la renta
                $.post('Historial.php', { rentaId: rentaId, nuevoEstado: nuevoEstado }, function(response) {
                    $('#mensajeEstado').text(response);
                    location.reload();

                });
            });
        });
    });
});
