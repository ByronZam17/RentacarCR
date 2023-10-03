document.addEventListener("DOMContentLoaded", function() {
    const registerForm = document.getElementById("registerForm");
    registerForm.addEventListener("submit", function(event) {
        event.preventDefault(); // Evitar el envío del formulario por defecto
        verificar();
    });
});

function verificar() {
    const usuario = document.getElementById("usuario").value;
    const password = document.getElementById("password").value;
    const tipo = document.querySelector("input[name='tipo']:checked").value;

    const data = new FormData();
    data.append("usuario", usuario);
    data.append("password", password);
    data.append("tipo", tipo);

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "registrar.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log("Usuario registrado exitosamente.");
                window.location.href = "http://localhost/DesarrolloWeb_proyecto/";
            } else {
                console.error("Error al registrar el usuario:", xhr.responseText);
            }
        }
    };
    xhr.send(data);
}