function loginUser() {
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "validar.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.role === 'admin') {
                    window.location.href = 'http://localhost/DesarrolloWeb_proyecto/Administrador/Home_admin.html';
                } else if (response.role === 'user') {
                    window.location.href = 'http://localhost/DesarrolloWeb_proyecto/Cliente/Home_cliente.html';
                } else {
                    alert("Credenciales incorrectas");
                }
            } else if (xhr.status === 401) {
                alert("Credenciales incorrectas");
            } else {
                alert("Error en la solicitud AJAX");
            }
        }
    };
    xhr.send("usuario=" + encodeURIComponent(username) + "&password=" + encodeURIComponent(password));

    return false; // Evita que el formulario se envíe tradicionalmente
}
