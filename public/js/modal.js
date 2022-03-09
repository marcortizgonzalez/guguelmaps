$(document).ready(function() {

    //////////////////////////////
    ////Event Handlers/////////////
    ///////////////////////////////
    $(".btn-grupo").on("click", function(e) {
        grupo();
    });
    $(".btn-grupo2").on("click", function(e) {
        unirGrupo();
    });
});

//////////////////////////////
//Funciones del modal box////////////
////////////////////////////
function grupo() {
    Swal.fire({
        title: 'Crear o unirse a grupo',
        text: 'Que quieres hacer?',
        confirmButtonText: 'Crear',
        denyButtonText: 'Unirse',
        showDenyButton: true,
        // showCancelButton: true,
        showCancelButton: false,
        inputValidator: (value) => {
            if (!value) {
                return 'Tienes que escribir algo!'
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            unirGrupo()
        } else if (result.isDenied) {
            crearGrupo()
        }


        console.log(result.value)
    });
}


function crearGrupo() {
    Swal.fire({
        title: 'Crear grupo',
        input: 'text',
        inputLabel: 'Nombre del grupo',
        confirmButtonText: 'Crear',
        cancelButtonText: 'no crear',
        showCancelButton: true,
        inputValidator: (value) => {
            if (!value) {
                return 'Tienes que escribir algo!'
            }
        }
    }).then((result) => {
        console.log(result.value)
    });
};

function unirGrupo() {
    Swal.fire({
        title: 'Unirse a grupo',
        input: 'text',
        inputLabel: 'Nombre del grupo',

        showCancelButton: true,
        inputValidator: (value) => {
            if (!value) {
                return 'Tienes que escribir algo!'
            }
        }
    }).then((result) => {
        console.log(result.value)
    });
};