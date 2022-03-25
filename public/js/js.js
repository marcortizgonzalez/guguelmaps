var locExis;
iconito1 = L.divIcon({
    html: `<i class="fad fa-map-marker-alt"></i>`,
    iconSize: [20, 20],
    className: 'iconoMapa'
});

$(document).ready(function() {

    $(".btn-gin").on("click", function(e) {
        elecGin();
    });


    // $(".owl-carousel").owlCarousel();
    ////Configuracion mapa
    map = L.map('map').setView([41.387668151941625, 2.1853189417337364], 16);
    //buscar ubicacion
    map.locate({})
    var popup = L.popup();
    layerg = L.layerGroup();
    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '',
        maxZoom: 18,
        tileSize: 512,
        zoomOffset: -1
    }).addTo(map);
    //anhadir el plugin de geolocalizacion
    map.on('locationfound', function(ev) {
        if (locExis == false) {
            locExis = true;
        }
        ubicacionUser = ev.latlng;

        //console.log(ubicacionUser)
    });
    L.control.locate().addTo(map);
    //LEER EL JSON DE LAS UBICACIONES ubis.json y meterlas en la layer de marcadores
    mostrar(0);
    //localizarse
    $(".start-gin").on("click", function(e) {

    });



    //filtro de las ubicaciones
    $(".content-tags .tag").each(function(index) {
        $(this).on('click touch', function(e) {
            e.preventDefault();
            // console.log('HOLA222')
            mostrar($(this).attr("id"))
        });
    });
    // $(".content-tags .tag").each(function(index) {
    //     $(this).on('click touch', function(e) {
    //         e.preventDefault();
    //         console.log('HOLA222')
    //         mostrar($(this).attr("id"))
    //     });
    // });
});

//LEER EL JSON DE LAS UBICACIONES ubis.json y meterlas en la layer de marcadores
function mostrar(filtro) {
    //boramos todos los datos de la capa de los marcadores
    layerg.clearLayers();
    $.getJSON('storage/lugares.json', function(data) {
        sitios = data[0];
        sitios.forEach(function(sitio, index) {
            if (filtro == 0 || sitio.id_tipo_fk == filtro) {
                var geoubi;

                if (!(sitio.coordenadas_lugar == "" || sitio.coordenadas_lugar == undefined || sitio.coordenadas_lugar == "undefined")) {
                    let lati = sitio.coordenadas_lugar.split(",")[0],
                        longi = sitio.coordenadas_lugar.split(",")[1];

                    $.getJSON('../public/storage/tipo.json').then(function(data) {
                        console.log("Dentro JSON")
                        tags = data[0];
                        tags.forEach(function(tag, index) {
                            if (sitio.id_tipo_fk == tag.id_tag) {
                                FATag = tag.icono_tag;
                                icono34 = `<i class="${FATag}"></i>`;
                                console.log(icono34)
                                    //console.log(FATag)
                            }
                        });
                        iconito1 = L.divIcon({
                            html: icono34,
                            iconSize: [20, 20],
                            className: 'iconoMapa'
                        });
                    });

                    marcador = L.marker([lati, longi], {
                        // icon: icono1(sitio.id_tipo_fk)
                        icon: iconito1
                    }).bindPopup(`
                <div><img src="" alt=""></div>
                <div>Nombre del lugar: ${sitio.nombre_lugar}</div>
                <div onclick="hacerRuta([${lati},${longi}], ubicacionUser)"><button>Iniciar ruta</button></div>
                <div class='btn-gincama' onclick="comprovarResp([${lati},${longi}], ubicacionUser, ${sitio.id_lugar})"><button>Comprobar punto</button></div>
                `);
                    layerg.addLayer(marcador)
                } else {
                    L.esri.Geocoding.geocode({ apikey: 'AAPK350e1a99963349a88d3aaa45c82978a33K6PhhjYv7Q6FDL5zegDREzmt2fW7_niV_r8kWkM32wRvWUBpuPA55TBlU6TkOZf' }).text(sitio.direccion_lugar).run(function(err, results, response) {
                        if (err) { console.log(err); }
                        geoubi = results;
                        var lat = results.results[index].latlng.lat,
                            long = results.results[index].latlng.lng;
                        var ubiCom = lat + "," + long,
                            ubiCom2 = "41.40724786200179, 2.153372584184284";
                        marcador = L.marker([lat, long], {
                            icon: icono1(sitio.id_tipo_fk)
                        }).bindPopup(`
                    <div><img src="" alt=""></div>
                    <div>Nombre del lugar: ${sitio.nombre_lugar}</div>
                    <div onclick="hacerRuta([${lat},${long}], [${ubicacionUser.lat} , ${ubicacionUser.lng}])"><button>Iniciar ruta</button></div>
                    `);
                        layerg.addLayer(marcador)
                    });
                }
            } else {
                console.log('no es el filtrado')
            }
        })
        layerg.addTo(map);
    });
};



//poner los iconos correspondientes
function icono1(idSitio) {
    icono34 = 'fad fa-map-marker-alt';
    var icono1,
        FATag = 'fad fa-map-marker-alt';
    console.log("Antes JSON")

    $.getJSON('../public/storage/tipo.json').then(function(data) {
        console.log("Dentro JSON")
        tags = data[0];
        tags.forEach(function(tag, index) {
            if (idSitio == tag.id_tag) {
                FATag = tag.icono_tag;
                icono34 = `<i class="${FATag}"></i>`;
                console.log(icono34)
                    //console.log(FATag)
            }
        });
    });
    return (L.divIcon({
        html: `<i class="${icono34}"></i>`,
        iconSize: [20, 20],
        className: 'iconoMapa'
    }))




}




//crear la ruta
routingControl = undefined;

function hacerRuta(punto, geoloc) {
    borrarRuta();
    console.log(punto);
    console.log(geoloc);
    routingControl = L.Routing.control({
        draggableWaypoints: false,
        createMarker: function() { return null; },
        waypoints: [
            L.latLng(punto),
            L.latLng(geoloc)
        ],
        addWaypoints: false,
        routeWhileDragging: false,
        fitSelectedRoutes: false,
    }).addTo(map);
};

function borrarRuta() {
    if (routingControl !== undefined) {
        map.removeControl(routingControl)
    }
};



//funcion para empezar la gincama.


////////////////////////////////////
//Empezar gincaman////
///////////////////////
function elecGin() {
    $.getJSON('../public/storage/gincana.json', function(data) {
        gincs = data[0];
        console.log(gincs)
        gincs.forEach(function(gin, index) {

            gincanasList = [
                { id: gin.id_gincana, name: gin.nombre_gincana }
            ];

            // gin.id_gincana;
            // gin.nombre_gincana;
            // gin.pista1_gincana;
            // gin.pista2_gincana;
            // gin.pista3_gincana;
            // gin.id_punto1_gincana;
            // gin.id_punto2_gincana;
            // gin.id_punto3_gincana;

        });
        var options = {};
        $.map(gincanasList,
            function(o) {
                options[o.id] = o.name;
            });

        Swal.fire({
            title: 'Empezar Gincana',
            input: 'select',
            inputOptions: options,
            confirmButtonText: 'Empezar',
            focusConfirm: false,
            inputValidator: (value) => {
                if (!value) {
                    return 'Tienes que elegir algo!'
                }
            }
        }).then((result) => {
            console.log(result.value)
            Cookies.set('ginVar', 1);
            Cookies.set('puntoGin', 1)
            Cookies.set('infoGin', result.value);
            startGin();
            //faltaria cnviat el boton de la gincama
        });
    });

}



//pulsas el boton de iniciar gincama y empieza la gim. le da un valor a una global var y con eso vamos comporvando que hemos empezado
function startGin() {
    Cookies.set('puntoGin', 1)

    $("<style id='stylesGin' type='text/css'> .btn-gincama{ display:block !important;} </style>").appendTo("head"); //hacemos que el boton de comprovar de gincama se vea
    Cookies.set('ginVar', 1);
    ginVar = 1;
    seleccionarPista()
    mostrarPista()
}

function seleccionarPista() {
    return new Promise((resolve, reject) => {
        $.getJSON('../public/storage/gincana.json', function(data) {
            gincs = data[0];
            var idGinc = gincs.findIndex(function(e) {
                return e.id_gincana == Cookies.get('infoGin');
            }); //variable donde tenemos el indice dentro del JSON de la gincana que estamos realizando
            switch (Cookies.get('puntoGin')) {
                case "1":
                    Cookies.set('pregunta', gincs[idGinc].pista1_gincana);
                    break;
                case "2":
                    Cookies.set('pregunta', gincs[idGinc].pista2_gincana);
                    break;
                case "3":
                    Cookies.set('pregunta', gincs[idGinc].pista3_gincana);
                    break;
                case "4":
                    Cookies.set('pregunta', gincs[idGinc].pista4_gincana);
                    break;
                case "5":
                    Cookies.set('pregunta', gincs[idGinc].pista5_gincana);
                    break;
                default:
                    break;
            }
        })
    });
}

function mostrarPista() { //funcion para mostrar la pista
    var pista = Cookies.get('pregunta')
    Swal.fire({
        title: 'La pista es...', //estaria bien poner el numero de la pista
        text: pista, //La pista
        icon: 'question',
        confirmButtonText: 'Entendido',
        focusConfirm: false,
    })
}


function comprovarResp(marcador, geoloc, idMarker) {
    var d = map.distance(marcador, geoloc);
    if (d <= 2000) { //si esta a menos de 20 metros...
        console.log(d)
        $.getJSON('../public/storage/gincana.json', function(data) {
            gincs = data[0];
            var idGinc = gincs.findIndex(function(e) {
                return e.id_gincana == Cookies.get('infoGin');
            }); //variable donde tenemos el indice dentro del JSON de la gincana que estamos realizando
            console.log(Cookies.get('puntoGin'))
            console.log(gincs[idGinc].id_punto1_fk)
            switch (Cookies.get('puntoGin')) {
                case "1":
                    if (gincs[idGinc].id_punto1_fk == idMarker) {
                        Swal.fire({
                            title: 'Correcto!!', //estaria bien poner el numero de la pista
                            text: 'Has acertado el punto, vamos a por el siguiente!!', //La pista
                            confirmButtonText: 'Siguiente Punto!',
                            icon: 'success'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                nextPoint()
                            }

                        });

                    } else {
                        Swal.fire({
                            title: 'Punto incorrecto!!!!!', //estaria bien poner el numero de la pista
                            text: 'No has acertado el punto!! Vuelve a intentar con otro!', //La pista
                            timer: 5000,
                            timerProgressBar: true,
                            icon: 'error'
                        }).then((result) => {
                            mostrarPista()
                        });
                    }
                    break;
                case "2":
                    if (gincs[idGinc].id_punto2_fk == idMarker) {
                        Swal.fire({
                            title: 'Correcto!!', //estaria bien poner el numero de la pista
                            text: 'Has acertado el punto, vamos a por el siguiente!!', //La pista
                            timer: 7000,
                            timerProgressBar: true,
                            icon: 'success'
                        }).then((result) => {
                            nextPoint()
                        });
                    } else {
                        Swal.fire({
                            title: 'Punto incorrecto!!!!!', //estaria bien poner el numero de la pista
                            text: 'No has acertado el punto!! Vuelve a intentar con otro!', //La pista
                            timer: 5000,
                            timerProgressBar: true,
                            icon: 'error'
                        }).then((result) => {
                            mostrarPista()
                        });
                    }
                    break;
                case "3":
                    if (gincs[idGinc].id_punto3_fk == idMarker) {
                        Swal.fire({
                            title: 'Correcto!!', //estaria bien poner el numero de la pista
                            text: 'Has acertado el punto, vamos a por el siguiente!!', //La pista
                            timer: 7000,
                            timerProgressBar: true,
                            icon: 'success'
                        }).then((result) => {
                            nextPoint()
                        });
                    } else {
                        Swal.fire({
                            title: 'Punto incorrecto!!!!!', //estaria bien poner el numero de la pista
                            text: 'No has acertado el punto!! Vuelve a intentar con otro!', //La pista
                            timer: 5000,
                            timerProgressBar: true,
                            icon: 'error'
                        })
                    }
                    break;
                case "4":
                    if (gincs[idGinc].id_punto4_fk == idMarker) {
                        Swal.fire({
                            title: 'Correcto!!', //estaria bien poner el numero de la pista
                            text: 'Has acertado el punto, vamos a por el siguiente!!', //La pista
                            timer: 5000,
                            timerProgressBar: true,
                            icon: 'success'
                        }).then((result) => {
                            nextPoint()
                        });
                    } else {
                        Swal.fire({
                            title: 'Punto incorrecto!!!!!', //estaria bien poner el numero de la pista
                            text: 'No has acertado el punto!! Vuelve a intentar con otro!', //La pista
                            timer: 5000,
                            timerProgressBar: true,
                            icon: 'error'
                        })
                    }
                    break;
                case "5":
                    if (gincs[idGinc].id_punto5_fk == idMarker) {
                        Swal.fire({
                            title: 'Correcto!!', //estaria bien poner el numero de la pista
                            text: 'Has acertado el punto, vamos a por el siguiente!!', //La pista
                            timer: 5000,
                            timerProgressBar: true,
                            icon: 'success'
                        }).then((result) => {
                            nextPoint()
                        });
                    } else {
                        Swal.fire({
                            title: 'Punto incorrecto!!!!!', //estaria bien poner el numero de la pista
                            text: 'No has acertado el punto!! Vuelve a intentar con otro!', //La pista
                            timer: 5000,
                            timerProgressBar: true,
                            icon: 'error'
                        })
                    }
                    break;
                default:
                    break;
            }
        })
    } else {
        Swal.fire({
            title: 'Demasiado lejos!!!', //estaria bien poner el numero de la pista
            text: 'Debes acercarte mas al punto (unos 20m max)', //La pista
            timer: 5000,
            timerProgressBar: true,
            icon: 'warning'
        })
    }

}

function nextPoint() {

    if (Cookies.get('puntoGin') != 3) {
        console.log(Cookies.get('puntoGin'))
        switch (Cookies.get('puntoGin')) {
            case "1":
                Cookies.set('puntoGin', 2)
                seleccionarPista()
                mostrarPista()
                break;
            case "2":
                Cookies.set('puntoGin', 3)
                seleccionarPista()
                mostrarPista()
                break;
            case "3":
                Cookies.set('puntoGin', 4)
                break;
            case "4":
                Cookies.set('puntoGin', 5)
                break;
            case "5":
                Cookies.set('puntoGin', 6)
                break;
            default:
                break;
        }


    } else {
        Swal.fire({
            title: 'Has acabado la gincama!!!', //estaria bien poner el numero de la pista
            text: 'Felicidades, has encontrado todos los puntos', //La pista
            timer: 5000,
            timerProgressBar: true,
            icon: 'success'
        })
        endGin();


    }
}


function endGin() {
    Cookies.set('ginVar', 0);
    ginVar = 0;
    Cookies.set('puntoGin', 0)
    Cookies.set('infoGin', 0);
    Cookies.set('pregunta', 0);
    $('#stylesGin').remove(); //ocultamos los botones de comprovar puntos otra vez
}