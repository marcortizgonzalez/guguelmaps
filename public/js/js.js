$(document).ready(function() {

    // $(".owl-carousel").owlCarousel();


    function ajax1(e, lati, long) {
        console.log("http://api.openweathermap.org/data/2.5/weather?lat=" + lati + "&lon=" + long + "&appid=8e2d5469f31e7a7cb5ff56e62c33f4be&units=metric&lang=Ca")
        $.ajax({
            type: "POST",
            url: "http://api.openweathermap.org/data/2.5/weather?lat=" + lati + "&lon=" + long + "&appid=8e2d5469f31e7a7cb5ff56e62c33f4be&units=metric&lang=Ca",
            dataType: "json",
            success: function(result, status, xhr) {
                // console.log(result);

                var contenido = `
                <img src='http://openweathermap.org/img/w/ ${result["weather"][0]["icon"]}.png'><br>
                Ciutat: ${result["name"]}<br>
                País:${result["sys"]["country"]}<br>
                Temperatura actual: ${result["main"]["temp"]}°C<br>
                Humitat: ${result["main"]["humidity"]}<br>
                Temps: ${result["weather"][0]["description"]}
                `
                popup
                    .setLatLng(e.latlng)
                    .setContent(
                        contenido
                    )
                    .openOn(map);
                // console.log(table);

            },
            error: function(xhr, status, error) {
                alert("Result: " + status + " " + error + " " + xhr.status + " " + xhr.statusText)
            }
        });


    }
    ////Configuracion mapa
    var map = L.map('map').setView([41.405143642716084, 2.149759037596462], 13);


    L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}{r}.png', {
        attribution: 'El isi',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'your.mapbox.access.token'
    }).addTo(map);
    var popup = L.popup();

    //Eventos en el mapa
    function onMapClick(e) {
        // let coordd = e.latlng.toString().replace("LatLng(", " ").replace(/ /g, "").replace(")", "")
        let long = e.latlng.lng
        let lat = e.latlng.lat
        console.log(long)
        ajax1(e, lat, long)
            // console.log()
            // popup
            //     .setLatLng(e.latlng)
            //     .setContent(
            //         ajax1(lat, long)
            //     )
            //     .openOn(map);
    }


    map.on('click', onMapClick);



});