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
    ajax.open("POST", "leerlugar", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            var recarga = '';
            recarga += '<tr>';
            recarga += '<th scope="col">ID</th>';
            recarga += '<th scope="col">Nombre</th>';
            recarga += '<th scope="col">Dirección</th>';
            recarga += '<th scope="col">Coordenadas</th>';
            recarga += '<th scope="col">Telefono</th>';
            recarga += '<th scope="col">Descripción</th>';
            recarga += '<th scope="col">Foto</th>';
            recarga += '<th scope="col">Tipo</th>';
            recarga += '<th scope="col">Tag</th>';
            recarga += '<th scope="col" colspan="2">Acciones</th>';
            recarga += '</tr>';
            for (let i = 0; i < respuesta.length; i++) {
                recarga += '<tr>';
                recarga += '<td scope="row">' + respuesta[i].id_lugar + '</td>';
                recarga += '<td>' + respuesta[i].nombre_lugar + '</td>';
                recarga += '<td>' + respuesta[i].direccion_lugar + '</td>';
                recarga += '<td>' + respuesta[i].coordenadas_lugar + '</td>';
                recarga += '<td>' + respuesta[i].telf_lugar + '</td>';
                recarga += '<td>' + respuesta[i].descripcion_lugar + '</td>';
                recarga += '<td><img src="storage/lugar/' + respuesta[i].foto_lugar + '" style="width:100px; height=100px;"></td>'
                recarga += '<td>' + respuesta[i].nombre_tipo + '</td>';
                recarga += '<td>' + respuesta[i].nombre_tag + '</td>';
                recarga += '<td><form action="./modificarLugar/' + respuesta[i].id_lugar + '" method="GET">';
                recarga += '<button class="btn btn-secondary" type="submit" name="Modificar" value="Modificar">Editar</button>';
                recarga += '</form></td>';
                recarga += '<td>';
                // eliminar
                recarga += '<form method="post">';
                recarga += '<input type="hidden" name="_method" value="DELETE" id="deleteLugar">';
                recarga += '<button class= "btn btn-danger" type="submit" value="Delete" onclick="eliminarJS(' + respuesta[i].id_lugar + ');return false;">Eliminar</button>';
                recarga += '</form>';
                recarga += '</td>';
                recarga += '</tr>';
            }
            table.innerHTML = recarga;
        }
    }
    ajax.send(formData)
}


function eliminarJS(id_lugar) {
    /* Si hace falta obtenemos el elemento HTML donde introduciremos la recarga (datos o mensajes) */
    /* Usar el objeto FormData para guardar los parámetros que se enviarán:
       formData.append('clave', valor);
       valor = elemento/s que se pasarán como parámetros: token, method, inputs... */
    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    formData.append('_method', 'DELETE');

    /* Inicializar un objeto AJAX */
    var ajax = objetoAjax();

    ajax.open("POST", "eliminarLugar/" + id_lugar, true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            leerJS();
        }
    }
    ajax.send(formData);
}