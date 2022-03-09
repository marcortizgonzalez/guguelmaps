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

/* function filtro() {
    var table = document.getElementById('table');
    var token = document.getElementById('token').getAttribute("content");
    var method = document.getElementById('postFiltro').value;
    var filtro = document.getElementById('search').value;

    var formData = new FormData();
    formData.append('_token', token);
    formData.append('_method', method);
    formData.append('nombre_usuario', filtro);

    var ajax = objetoAjax();
    ajax.open("POST", "filtro", true);
    ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
                var respuesta = JSON.parse(this.responseText);
                var recarga = '';
                recarga += '<tr>';
                recarga += '<th scope="col">ID</th>';
                recarga += '<th scope="col">Nombre</th>';
                recarga += '<th scope="col">Email</th>';
                recarga += '<th scope="col">Telefono</th>';
                recarga += '<th scope="col">Foto</th>';
                recarga += '<th scope="col">Rol</th>';
                recarga += '<th scope="col">Grupo</th>';
                recarga += '<th scope="col" colspan="2">Acciones</th>';
                recarga += '</tr>';
                for (let i = 0; i < respuesta.length; i++) {
                    recarga += '<tr>';
                    recarga += '<td scope="row">' + respuesta[i].id + '</td>';
                    recarga += '<td>' + respuesta[i].nombre_usuario + '</td>';
                    recarga += '<td>' + respuesta[i].email_usuario + '</td>';
                    recarga += '<td>' + respuesta[i].telf_usuario + '</td>';
                    recarga += '<td><img src="storage/usuarios/' + respuesta[i].foto_usuario + '" style="width:100px; height=100px;"></td>'
                    recarga += '<td>' + respuesta[i].nombre_rol + '</td>';
                    recarga += '<td>' + respuesta[i].nombre_grupo + '</td>';
                    recarga += '<td>';
                    // editar
                    recarga += '<button class="btn btn-secondary" type="submit" value="Edit" onclick="modalbox(' + respuesta[i].id + ',\'' + respuesta[i].nombre_usuario + '\',\'' + respuesta[i].email_usuario + ',\'' + respuesta[i].contra_usuario + ',\'' + respuesta[i].telf_usuario + ',\'' + respuesta[i].foto_usuario + '\');return false;">Editar</button>';
                    recarga += '</td>';
                    recarga += '<td>';
                    // eliminar
                    recarga += '<form method="post">';
                    recarga += '<input type="hidden" name="_method" value="DELETE" id="deleteUsuario">';
                    recarga += '<button class= "btn btn-danger" type="submit" value="Delete" onclick="eliminar(' + respuesta[i].id + ');return false;">Eliminar</button>';
                    recarga += '</form>';
                    recarga += '</td>';
                    recarga += '</tr>';
                }
                table.innerHTML = recarga;
            }
        }
    ajax.send(formData)
} */

function crear() {
    var message = document.getElementById('message');
    var token = document.getElementById('token').getAttribute("content");
    var method = document.getElementById('createUsuario').value;
    var formData = new FormData(document.getElementById('formcrear'));
    formData.append('_token', token);
    formData.append('_method', method);
    var ajax = objetoAjax();
    ajax.open("POST", "crear", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            if (respuesta.resultado == "OK") {
                message.innerHTML = '<p>Usuario creado correctamente.</p>';

            } else {
                message.innerHTML = 'Ha habido un error:' + respuesta.resultado;
            }
            filtro();
            document.getElementById('nombre_usuario').value = "";
            document.getElementById('email_usuario').value = "";
            document.getElementById('contra_usuario').value = "";
            document.getElementById('telf_usuario').value = "";
            document.getElementById('foto_usuario').value = "";
            document.getElementById('nombre_usuario').focus();
        }
    }
    ajax.send(formData)
}

function eliminar(usuario_id) {
    var message = document.getElementById('message');
    /* Obtener elemento html donde introduciremos la recarga (datos o mensajes) */

    /* 
    Obtener elemento/s que se pasarán como parámetros: token, method, inputs... 
    var token = document.getElementById('token').getAttribute("content");
 
    Usar el objeto FormData para guardar los parámetros que se enviarán:
    var formData = new FormData();
    formData.append('_token', token);
    formData.append('clave', valor);
    */
    var token = document.getElementById('token').getAttribute("content");
    var method = document.getElementById('deleteUsuario').value;
    var formData = new FormData();
    formData.append('_token', token);
    formData.append('_method', 'DELETE');
    /* Inicializar un objeto AJAX */
    var ajax = objetoAjax();
    /*
    ajax.open("method", "rutaURL", true);
    GET  -> No envía parámetros
    POST -> Sí envía parámetros
    true -> asynchronous
    */
    ajax.open("POST", "eliminar/" + usuario_id, true);
    ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
                var respuesta = JSON.parse(this.responseText);
                if (respuesta.resultado == "OK") {
                    /* creación de estructura: la estructura que creamos no ha de contener código php ni código blade*/
                    //    /* utilizamos innerHTML para introduciremos la recarga en el elemento html pertinente */
                    message.innerHTML = '<p>Usuario eliminado correctamente.</p>';

                } else {
                    //    /* creación de estructura: la estructura que creamos no ha de contener código php ni código blade*/
                    /* utilizamos innerHTML para introduciremos la recarga en el elemento html pertinente */
                    message.innerHTML = 'Ha habido un error:' + respuesta.resultado;
                }
            }
            filtro();
        }
        /*
        send(string)->Sends the request to the server (used for POST)
        */
    ajax.send(formData)
}

function actualizar() {
    var message = document.getElementById('message');
    /* Obtener elemento html donde introduciremos la recarga (datos o mensajes) */

    /* 
    Obtener elemento/s que se pasarán como parámetros: token, method, inputs... 
    var token = document.getElementById('token').getAttribute("content");
 
    Usar el objeto FormData para guardar los parámetros que se enviarán:
    var formData = new FormData();
    formData.append('_token', token);
    formData.append('clave', valor);
    */
    var token = document.getElementById('token').getAttribute("content");
    var method = document.getElementById('modifUsuario').value;
    var formData = new FormData(document.getElementById('formUpdate'));
    formData.append('_token', token);
    formData.append('_method', method);
    /* Inicializar un objeto AJAX */
    var ajax = objetoAjax();
    /*
    ajax.open("method", "rutaURL", true);
    GET  -> No envía parámetros
    POST -> Sí envía parámetros
    true -> asynchronous
    */
    ajax.open("POST", "actualizar", true);
    ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
                var respuesta = JSON.parse(this.responseText);
                if (respuesta.resultado == "OK") {
                    /* creación de estructura: la estructura que creamos no ha de contener código php ni código blade*/
                    //    /* utilizamos innerHTML para introduciremos la recarga en el elemento html pertinente */
                    message.innerHTML = '<p>Usuario modificado correctamente.</p>';

                } else {
                    //    /* creación de estructura: la estructura que creamos no ha de contener código php ni código blade*/
                    /* utilizamos innerHTML para introduciremos la recarga en el elemento html pertinente */
                    message.innerHTML = 'Ha habido un error:' + respuesta.resultado;
                }
            }
            filtro();
        }
        /*
        send(string)->Sends the request to the server (used for POST)
        */
    ajax.send(formData)

}