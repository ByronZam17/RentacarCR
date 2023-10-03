function agregarNuevo() {
    var articulos = document.getElementById("articulos").value;
    var cantidad = document.getElementById("cantidad").value;
    var precio = document.getElementById("precio").value;

// Crear un objeto FormData para enviar datos y archivos al servidor
    var formData = new FormData();
    formData.append("articulos", articulos);
    formData.append("cantidad", cantidad);
    formData.append("precio", precio);



    // Hacer una solicitud AJAX para enviar los datos al servidor
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "consultas.php", true);
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // La solicitud se completó con éxito, aquí puedes manejar la respuesta
                console.log("Solicitud exitosa:", xhr.responseText);
                // Recargar la página o actualizar la lista de vehículos aquí
                location.reload();
            } else {
                // Ocurrió un error en la solicitud
                console.error("Error en la solicitud:", xhr.status);
            }
        }
    };

    xhr.send(formData); // Enviar el formulario al servidor
}


function cargarListaDesdeDB() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "consultas.php", true);

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                try {
                    var listaDeResultados = JSON.parse(xhr.responseText);
                    mostrarResultadosEnPagina(listaDeResultados);
                } catch (error) {
                    console.error("Error al analizar JSON:", error);
                }
            } else {
                console.error("Error en la solicitud:", xhr.status);
            }
        }
    };

    xhr.send();
}

function mostrarResultadosEnPagina(resultados) {
    var tablaHTML = "<table>";
    tablaHTML += "<tr><th>ID</th><th>Articulos</th><th>Cantidad</th><th>Precio</th><th>Acciones</th><br>";
    for (var i = 0; i < resultados.length; i++) {
        tablaHTML += `
            <tr>
                <td>${resultados[i].ID}</td>
                <td>${resultados[i].articulos}</td>
                <td>${resultados[i].cantidad}</td>
                <td>${resultados[i].precio}</td>
                <td>
                    <button class="eliminar btn btn-danger" onclick="eliminarRegistro(${resultados[i].ID})">Eliminar</button>
                    <button class="editar btn btn-primary" onclick="redirigirAEditar(${resultados[i].ID})">Editar</button>
                </td>
            </tr>`;
    }
    tablaHTML += "</table>";

    var tablaContainer = document.getElementById("tabla");
    tablaContainer.innerHTML = tablaHTML;
}

window.onload = function() {
    cargarListaDesdeDB();
};

function redirigirAEditar(ID) {
    window.location.href = `Editar.php?id=${ID}`;
}

function eliminarRegistro(id) {
    if (confirm("¿Estás seguro de que deseas eliminar este registro?")) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "eliminar.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Eliminación exitosa, puedes redirigir o mostrar un mensaje
                    alert(xhr.responseText);
                    // Recargar la página automáticamente
                    location.reload();
                } else {
                    alert("Error al eliminar el registro");
                }
            }
        };
        xhr.send("id=" + id);
    }
}












