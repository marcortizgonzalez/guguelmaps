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
    ajax.open("POST", "leertag", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            var recarga = '';
            recarga += '<tr>';
            recarga += '<th scope="col"><b>ID</b></th>';
            recarga += '<th scope="col"><b>Nombre tag</b></th>';
            recarga += '<th scope="col"><b>Icono</b></th>';
            recarga += '<th scope="col" colspan="2"><b>Acciones</b></th>';
            recarga += '</tr>';
            for (let i = 0; i < respuesta.length; i++) {
                recarga += '<tr>';
                recarga += '<td scope="row">' + respuesta[i].id_tag + '</td>';
                recarga += '<td>' + respuesta[i].nombre_tag + '</td>';
                recarga += '<td><i class="' + respuesta[i].icono_tag + '"></i></td>';

                recarga += '<td><form action="./modificarTag/' + respuesta[i].id_tag + '" method="GET">';
                recarga += '<button class="btn btn-secondary" type="submit" name="Modificar" value="Modificar">Editar</button>';
                recarga += '</form></td>';
                recarga += '<td>';
                // eliminar tag
                recarga += '<form method="get">';
                recarga += '<input type="hidden" name="_method" value="DELETE" id="deleteTag">';
                recarga += '<button class="btn btn-danger" type="submit" value="Delete" onclick="eliminarTagJS(' + respuesta[i].id_tag + ');return false;">Eliminar</button>';
                recarga += '</form>';
                recarga += '</td>';
                recarga += '</tr>';
            }
            table.innerHTML = recarga;
        }
    }
    ajax.send(formData)
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* Función implementada con AJAX que ELIMINA un archivo */
function eliminarTagJS(id_tag) {
    /* Si hace falta obtenemos el elemento HTML donde introduciremos la recarga (datos o mensajes) */
    /* Usar el objeto FormData para guardar los parámetros que se enviarán:
       formData.append('clave', valor);
       valor = elemento/s que se pasarán como parámetros: token, method, inputs... */
    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    formData.append('_method', 'DELETE');

    /* Inicializar un objeto AJAX */
    var ajax = objetoAjax();

    ajax.open("POST", "eliminarTag/" + id_tag, true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            leerJS();
        }
    }
    ajax.send(formData);
}