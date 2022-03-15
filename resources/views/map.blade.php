<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Center the map</title>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/leaflet.esri.geocoder/2.1.0/esri-leaflet-geocoder.css">
    <script src="js/code.js"></script>
    {{-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script> --}}

    <!-- Load Leaflet from CDN -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>

</head>
<body>
    <div id="map"></div>
    <div class="login flex-cv">
        @if (Session::get('nombre_admin') || Session::get('nombre_cliente'))
        <a href="{{url('logout')}}">
            <button type="button" >Logout</button>
        </a>
        @else
        <a href="{{url('secciones')}}" {{-- onclick="modalbox({{$usuario->email_usuario}},'{{$usuario->contra_usuario}}');return false;" --}}>
            <img src="storage/usuarios/default.png" height="50px" width="50px">
        </a>
        @endif
    </div>
    
    {{-- <table id="tablajson">
        <thead>
            <th>Id</th>
            <th>Nombre</th>
            <th>coordenadas_lugar</th>
            <th>direccion_lugar</th>
            <th>telf_lugar</th>			
            <th>descripcion_lugar</th>
            <th>foto_lugar</th>
            <th>nombre_tipo</th>
            <th>nombre_tag</th>			
        </thead>
        <tbody></tbody>
    </table>
    
    <script type="text/javascript">
        $.ready(function() {
                var url = "generarJSON.php";
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
        </script> --}}
</body>

</html>