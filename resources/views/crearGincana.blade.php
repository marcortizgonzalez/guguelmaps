<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Crear Gincana</title>
</head>
<body>
    <div>
        <form class="back" action="{{url('gincanas')}}" method="GET">
            <button><img src="./media/back.png" type="submit" name="back" value="back" width="50px" height="50px"></button>
        </form>
    </div>
    <center>
        <form class="cuadro_login" action="{{url('crearGincana')}}" method="post" enctype="multipart/form-data">
            @csrf
            {{method_field('POST')}}
            <p>Nombre de la gincana:</p>
                <input class="btn-outline-success" type="text" name="nombre_gincana">
                @error('nombre_gincana')
                    <br>
                    {{$message}}
                @enderror
            <p>Pista 1:</p>
                <input class="btn-outline-success" type="text" name="pista1_gincana">
                @error('pista1_gincana')
                    <br>
                    {{$message}}
                @enderror
            <p>Punto 1:</p>
            
                <select class="btn-outline-success" name="id_punto1_fk" id="id_punto1_fk">
                    <option value=""></option>
                    @foreach ($lugar as $lugar)
                        <option value="{{$lugar->id_lugar}}">{{$lugar->nombre_lugar}}</option>
                    @endforeach
                </select>
                @error('id_punto1_fk')
                    <br>
                    {{$message}}
                @enderror
                <p>Pista 2:</p>
                <input class="btn-outline-success" type="text" name="pista2_gincana">
                @error('pista2_gincana')
                    <br>
                    {{$message}}
                @enderror
            <p>Punto 2:</p>
                <select class="btn-outline-success" name="id_punto2_fk" id="id_punto2_fk">
                    <option value=""></option>
                    @foreach ($lugar2 as $lugar)
                        <option value="{{$lugar->id_lugar}}">{{$lugar->nombre_lugar}}</option>
                    @endforeach
                </select>
                @error('id_punto2_fk')
                    <br>
                    {{$message}}
                @enderror
                <p>Pista 3:</p>
                <input class="btn-outline-success" type="text" name="pista3_gincana">
                @error('pista3_gincana')
                    <br>
                    {{$message}}
                @enderror
            <p>Punto 3:</p>
                <select class="btn-outline-success" name="id_punto3_fk" id="id_punto3_fk">
                    <option value=""></option>
                    @foreach ($lugar3 as $lugar)
                        <option value="{{$lugar->id_lugar}}">{{$lugar->nombre_lugar}}</option>
                    @endforeach
                </select>
                @error('id_punto3_fk')
                    <br>
                    {{$message}}
                @enderror
            <br><br>
            <div>
                <input type="submit" value="Crear">
            </div>
        </form>
    </center>
    <img src="./media/gincana.png" name="back" value="back" width="50px" height="50px">
</body>
</html>