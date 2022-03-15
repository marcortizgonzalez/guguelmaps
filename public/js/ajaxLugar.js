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

function filtro() {
    var table = document.getElementById('table');
    var token = document.getElementById('token').getAttribute("content");

    var formData = new FormData();
    formData.append('_token', token);
    formData.append('_method', 'post');

    var ajax = objetoAjax();
    ajax.open("POST", "filtro", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            var recarga = '';
            recarga += '<tr>';
            recarga += '<th scope="col">ID</th>';
            recarga += '<th scope="col">Nombre</th>';
            recarga += '<th scope="col">Ubicación</th>';
            recarga += '<th scope="col">Dirección</th>';
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
                recarga += '<td>' + respuesta[i].ubi_lugar + '</td>';
                recarga += '<td>' + respuesta[i].direccion_lugar + '</td>';
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
                recarga += '<button class= "btn btn-danger" type="submit" value="Delete" onclick="eliminar(' + respuesta[i].id_lugar + ');return false;">Eliminar</button>';
                recarga += '</form>';
                recarga += '</td>';
                recarga += '</tr>';
            }
            table.innerHTML = recarga;
        }
    }
    ajax.send(formData)
}

function crear() {
    var message = document.getElementById('message');
    var token = document.getElementById('token').getAttribute("content");
    var method = document.getElementById('createLugar').value;
    var formData = new FormData(document.getElementById('formcrear'));
    formData.append('_token', token);
    formData.append('_method', method);
    var ajax = objetoAjax();
    ajax.open("POST", "crear", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            if (respuesta.resultado == "OK") {
                message.innerHTML = '<p>Lugar creado correctamente.</p>';

            } else {
                message.innerHTML = 'Ha habido un error:' + respuesta.resultado;
            }
            filtro();
            document.getElementById('nombre_lugar').value = "";
            document.getElementById('ubi_lugar').value = "";
            document.getElementById('direccion_lugar').value = "";
            document.getElementById('telf_lugar').value = "";
            document.getElementById('descripcion_lugar').value = "";
            document.getElementById('foto_lugar').value = "";
            document.getElementById('id_tipo_fk').value = "";
            document.getElementById('nombre_lugar').focus();
        }
    }
    ajax.send(formData)
}

function eliminar(lugar_id) {
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
    var method = document.getElementById('deleteLugar').value;
    var formData = new FormData();
    formData.append('_token', token);
    formData.append('_method', 'DELETE');
    formData.append('id', lugar_id);
    /* Inicializar un objeto AJAX */
    var ajax = objetoAjax();
    /*
    ajax.open("method", "rutaURL", true);
    GET  -> No envía parámetros
    POST -> Sí envía parámetros
    true -> asynchronous
    */
    ajax.open("POST", "eliminar", true);
    ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
                var respuesta = JSON.parse(this.responseText);
                if (respuesta.resultado == "OK") {
                    /* creación de estructura: la estructura que creamos no ha de contener código php ni código blade*/
                    //    /* utilizamos innerHTML para introduciremos la recarga en el elemento html pertinente */
                    message.innerHTML = '<p>Lugar eliminado correctamente.</p>';

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
    var method = document.getElementById('modifLugar').value;
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
                    message.innerHTML = '<p>Lugar modificado correctamente.</p>';

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

/* function JSON() {
    ajax.open("GET", "JSON", true);
    $(document).ready(function() {
        var url = "/app/Http/Controllers/LugarController.php";
        $("#tablajson tbody").html("");
        $.getJSON(url, function(lugares) {
            $.each(lugares, function(i, lugar) {
                var newRow =
                    "<tr>" +
                    "<td>" + lugar.id_lugar + "</td>" +
                    "<td>" + lugar.nombre_lugar + "</td>" +
                    "<td>" + lugar.coordenadas_lugar + "</td>" +
                    "<td>" + lugar.direccion_lugar + "</td>" +
                    "<td>" + lugar.telf_lugar + "</td>" +
                    "<td>" + lugar.descripcion_lugar + "</td>" +
                    "<td>" + lugar.foto_lugar + "</td>" +
                    "<td>" + lugar.nombre_tipo + "</td>" +
                    "<td>" + lugar.nombre_tag + "</td>" +
                    "</tr>";
                $(newRow).appendTo("#tablajson tbody");
            });
        });
    });
} */