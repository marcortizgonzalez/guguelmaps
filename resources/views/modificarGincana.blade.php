<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style.css">
    <title>Modificar Gincana</title>
</head>
<body>
    <div>
        <form class="back" action="{{url('gincanas')}}" method="GET">
            <button><img src="../media/back.png" type="submit" name="back" value="back" width="50px" height="50px"></button>
        </form>
    </div>
    <center>
        <form class="cuadro_login" action="{{url('modificarGincana')}}" method="post" enctype="multipart/form-data">
            @csrf
            {{method_field('PUT')}}
            <p>Nombre de la gincana:</p>
            <input class="btn-outline-success" type="text" name="nombre_gincana" value="{{$gincana->nombre_gincana}}">
            <p>Pista 1:</p>
            <input class="btn-outline-success" type="text" name="pista1_gincana" value="{{$gincana->pista1_gincana}}">
            <p>Punto 1:</p>
            <select class="btn-outline-success" name="id_punto1_fk" id="id_punto1_fk">
                @foreach ($lugar as $lugar)
                    @if ($gincana->id_punto1_fk == $lugar->id_lugar)
                        <option value="{{$lugar->id_lugar}}" selected>{{$lugar->nombre_lugar}}</option>
                    @else
                        <option value="{{$lugar->id_lugar}}">{{$lugar->nombre_lugar}}</option>
                    @endif   
                @endforeach
            </select>

            <p>Pista 2:</p>
            <input class="btn-outline-success" type="text" name="pista2_gincana" value="{{$gincana->pista2_gincana}}">
            <p>Punto 2:</p>
            <select class="btn-outline-success" name="id_punto2_fk" id="id_punto2_fk">
                @foreach ($lugar2 as $lugar)
                    @if ($gincana->id_punto2_fk == $lugar->id_lugar)
                        <option value="{{$lugar->id_lugar}}" selected>{{$lugar->nombre_lugar}}</option>
                    @else
                        <option value="{{$lugar->id_lugar}}">{{$lugar->nombre_lugar}}</option>
                    @endif   
                @endforeach
            </select>

            <p>Pista 3:</p>
            <input class="btn-outline-success" type="text" name="pista3_gincana" value="{{$gincana->pista3_gincana}}">
            <p>Punto 3:</p>
            <select class="btn-outline-success" name="id_punto3_fk" id="id_punto3_fk">
                @foreach ($lugar3 as $lugar)
                    @if ($gincana->id_punto3_fk == $lugar->id_lugar)
                        <option value="{{$lugar->id_lugar}}" selected>{{$lugar->nombre_lugar}}</option>
                    @else
                        <option value="{{$lugar->id_lugar}}">{{$lugar->nombre_lugar}}</option>
                    @endif   
                @endforeach
            </select>
            <br><br>
            <div>
                <input type="hidden" name="id_gincana" value="{{$gincana->id_gincana}}">
                <input class="btn btn-success" type="submit" value="Modificar">
            </div>
        </form>
    </center>
    <img src="../media/gincana.png" name="back" value="back" width="50px" height="50px">
</body>
</html>