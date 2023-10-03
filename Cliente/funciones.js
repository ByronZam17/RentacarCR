function cargarListaDesdeDB() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "Lista.php", true);

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
    tablaHTML += "<tr><th>Placa</th><th>Marca</th><th>Año</th><th>Tipo</th><th>Precio</th><th>Imagen</th><th>Acciones</th></tr><br>";
    for (var i = 0; i < resultados.length; i++) {
        tablaHTML += `
            <tr>
                <td>${resultados[i].placa}</td>
                <td>${resultados[i].Marca}</td>
                <td>${resultados[i].anio}</td>
                <td>${resultados[i].tipo}</td>
                <td>${resultados[i].Precio}</td>
                <td><img src="${resultados[i].imagen}" style="max-width: 100px;"></td>
                <td>
                    <button class="editar btn btn-primary" onclick="redirigirAEditar()">selecionar</button>
                </td>
            </tr>`;
    }
    tablaHTML += "</table>";

    var tablaContainer = document.getElementById("tabla_productos");
    tablaContainer.innerHTML = tablaHTML;
}

window.onload = function() {
    cargarListaDesdeDB();
};

function redirigirAEditar() {
    window.location.href = `Rentas/panel.php`;
}