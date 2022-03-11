<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Crear Lugar</title>
</head>
<body>
    <div>
        <form class="back" action="{{url('lugares')}}" method="GET">
            <button><img src="./media/back.png" type="submit" name="back" value="back" width="50px" height="50px"></button>
        </form>
    </div>
    <center>
        <form class="cuadro_login" action="{{url('crearLugar')}}" method="post" enctype="multipart/form-data">
            @csrf
            {{method_field('POST')}}
            <p>Nombre:</p>
                <input class="btn-outline-success" type="text" name="nombre_lugar">
                @error('nombre_lugar')
                    <br>
                    {{$message}}
                @enderror
            <p>Coordenadas:</p>
                <input class="btn-outline-success" type="text" name="coordenadas_lugar">
                @error('coordenadas_lugar')
                    <br>
                    {{$message}}
                @enderror
            <p>Descripción:</p>
                <input class="btn-outline-success" type="text" name="descripcion_lugar">
                @error('descripcion_lugar')
                    <br>
                    {{$message}}
                @enderror
            <p>Foto:</p>
                <input type="file" name="foto_lugar">
                @error('foto_lugar')
                    <br>
                    {{$message}}
                @enderror
            <p>Tipo:</p>
            <select class="btn-outline-success" name="id_tipo_fk" id="id_tipo_fk">
                <option value=""></option>
                @foreach ($tipo as $tipo)
                    <option value="{{$tipo->id_tipo}}">{{$tipo->nombre_tipo}}</option>
                @endforeach
            </select>
                @error('id_tipo_fk')
                    <br>
                    {{$message}}
                @enderror
            <p>Tag:</p>
            <select class="btn-outline-success" name="id_tag_fk" id="id_tag_fk">
                <option value=""></option>
                @foreach ($tag as $tag)
                    <option value="{{$tag->id_tag}}">{{$tag->nombre_tag}}</option>
                @endforeach
            </select>
                @error('id_tag_fk')
                    <br>
                    {{$message}}
                @enderror
            <br><br>
            <div>
                <input type="submit" value="Crear">
            </div>
        </form>
    </center>
    <img src="./media/mapa.png" name="back" value="back" width="50px" height="50px">
</body>
</html>