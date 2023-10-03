function agregarNuevo() {
    var provincia = document.getElementById("provincia").value;
    var personal = document.getElementById("personal").value;
    var disposicion = document.getElementById("disposicion").value;
    var direccion = document.getElementById("direccion").value;

// Crear un objeto FormData para enviar datos y archivos al servidor
    var formData = new FormData();
    formData.append("provincia", provincia);
    formData.append("personal", personal);
    formData.append("disposicion", disposicion);
    formData.append("direccion", direccion);


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
    tablaHTML += "<tr><th>ID</th><th>Provincia</th><th>Personal</th><th>Disponibilidad</th><th>Direccion</th><th>Acciones</th></tr><br>";
    for (var i = 0; i < resultados.length; i++) {
        tablaHTML += `
            <tr>
                <td>${resultados[i].ID}</td>
                <td>${resultados[i].provincia}</td>
                <td>${resultados[i].personal}</td>
                <td>${resultados[i].disposicion}</td>
                <td>${resultados[i].direccion}</td>
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












