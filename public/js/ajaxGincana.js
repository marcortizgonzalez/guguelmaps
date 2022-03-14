window.onload = function() {
    leerJS();
}

function objetoAjax() {
    var xmlhttp = false;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}

function leerJS() {
    var table = document.getElementById('table');
    var token = document.getElementById('token').getAttribute("content");

    var formData = new FormData();
    formData.append('_token', token);
    formData.append('_method', 'post');

    var ajax = objetoAjax();
    ajax.open("POST", "leergincana", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            var recarga = '';
            recarga += '<tr>';
            recarga += '<th scope="col">ID</th>';
            recarga += '<th scope="col">Nombre de la gincana</th>';
            recarga += '<th scope="col">Pista 1</th>';
            recarga += '<th scope="col">Punto 1</th>';
            recarga += '<th scope="col">Pista 2</th>';
            recarga += '<th scope="col">Punto 2</th>';
            recarga += '<th scope="col">Pista 3</th>';
            recarga += '<th scope="col">Punto 3</th>';
            recarga += '<th scope="col" colspan="2">Acciones</th>';
            recarga += '</tr>';
            for (let i = 0; i < respuesta.length; i++) {
                recarga += '<tr>';
                recarga += '<td scope="row">' + respuesta[i].id_gincana + '</td>';
                recarga += '<td>' + respuesta[i].nombre_gincana + '</td>';
                recarga += '<td>' + respuesta[i].pista1_gincana + '</td>';
                recarga += '<td>' + respuesta[i].id_punto1_fk + '</td>';
                recarga += '<td>' + respuesta[i].pista2_gincana + '</td>';
                recarga += '<td>' + respuesta[i].id_punto2_fk + '</td>';
                recarga += '<td>' + respuesta[i].pista3_gincana + '</td>';
                recarga += '<td>' + respuesta[i].id_punto3_fk + '</td>';
                recarga += '<td><form action="./modificarGincana/' + respuesta[i].id_gincana + '" method="GET">';
                recarga += '<button class="btn btn-secondary" type="submit" name="Modificar" value="Modificar">Editar</button>';
                recarga += '</form></td>';
                recarga += '<td>';
                // eliminar
                recarga += '<form method="post">';
                recarga += '<input type="hidden" name="_method" value="DELETE" id="deleteGincana">';
                recarga += '<button class= "btn btn-danger" type="submit" value="Delete" onclick="eliminarJS(' + respuesta[i].id_gincana + ');return false;">Eliminar</button>';
                recarga += '</form>';
                recarga += '</td>';
                recarga += '</tr>';
            }
            table.innerHTML = recarga;
        }
    }
    ajax.send(formData)
}


function eliminarJS(id_gincana) {
    /* Si hace falta obtenemos el elemento HTML donde introduciremos la recarga (datos o mensajes) */
    /* Usar el objeto FormData para guardar los parámetros que se enviarán:
       formData.append('clave', valor);
       valor = elemento/s que se pasarán como parámetros: token, method, inputs... */
    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    formData.append('_method', 'DELETE');

    /* Inicializar un objeto AJAX */
    var ajax = objetoAjax();

    ajax.open("POST", "eliminarGincana/" + id_gincana, true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            leerJS();
        }
    }
    ajax.send(formData);
}