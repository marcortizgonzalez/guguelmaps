window.onload = function() {
    leerJS();

    // // Get the modal
    // modal = document.getElementById("myModal");

    // // Get the <span> element that closes the modal
    // span = document.getElementsByClassName("close")[0];

    // // When the user clicks on <span> (x), close the modal
    // span.onclick = function() {
    //     modal.style.display = "none";
    // }

    // // When the user clicks anywhere outside of the modal, close it
    // window.onclick = function(event) {
    //     if (event.target == modal) {
    //         modal.style.display = "none";
    //     }
    // }
}

// When the user clicks the button, open the modal 
function abrirModal() {
    // modal.style.display = "block";

    Swal.fire({
        title: 'Crear nuevo TAG',
        //html: '<input type="text" id=nombre_tag" class="input_tag" placeholder="Texto de ejemplo">',
        input: 'text',
        confirmButtonText: 'Crear',
        focusConfirm: false,
        inputValidator: (value) => {
            if (!value) {
                return 'Tienes que escribir algo!'
            }
        }
    }).then((result) => {
        console.log(result.value)
        crearTagJS(result.value)
    });


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
    var tabla = document.getElementById("main");
    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));

    var ajax = objetoAjax();
    ajax.open("POST", "leertaguser", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            var recarga = '';
            recarga += '<div class="content-tags">';
            for (let i = 0; i < respuesta.length; i++) {
                recarga += '<div class="tag">';
                recarga += '<i class="fad fa-tag"></i><span class="txt-tag">&nbsp' + respuesta[i].nombre_tag_usuario + '</span>';
                recarga += '</div>';
            }
            recarga += '</div>';

            // crear
            recarga += '<div class="create-tag"><span><i class="fad fa-plus" style="cursor: pointer" onclick="abrirModal();return false;"></i></span></div>';

            tabla.innerHTML = recarga;
        }
    }
    ajax.send(formData)
}

//HACER CREAR

/* Función implementada con AJAX que inserta un archivo */
function crearTagJS(valor) {

    /* Si hace falta obtenemos el elemento HTML donde introduciremos la recarga (datos o mensajes) */
    /* Usar el objeto FormData para guardar los parámetros que se enviarán:
       formData.append('clave', valor);
       valor = elemento/s que se pasarán como parámetros: token, method, inputs... */
    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    formData.append('nombre', valor);

    /* Inicializar un objeto AJAX */
    var ajax = objetoAjax();

    ajax.open("POST", "creartagusu", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            leerJS();
        }
    }

    ajax.send(formData);
}