<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style.css">
    <title>Modificar Usuario</title>
</head>
<body>
    <div>
        <form class="back" action="{{url('lugares')}}" method="GET">
            <button><img src="../media/back.png" type="submit" name="back" value="back" width="50px" height="50px"></button>
        </form>
    </div>
    <center>
        <form class="cuadro_login" action="{{url('modificarLugar')}}" method="post" enctype="multipart/form-data">
            @csrf
            {{method_field('PUT')}}
            <p>Nombre:</p>
            <input class="btn-outline-success" type="text" name="nombre_lugar" value="{{$lugar->nombre_lugar}}">
            <p>Coordenadas:</p>
            <input class="btn-outline-success" type="text" name="coordenadas_lugar" value="{{$lugar->coordenadas_lugar}}">
            <p>Descripción:</p>
            <input class="btn-outline-success" type="text" name="descripcion_lugar" value="{{$lugar->descripcion_lugar}}">
            <p>Foto:</p>
            <input type="file" name="foto_lugar" value="">
            <p>Tipo:</p>
            <select class="btn-outline-success" name="id_tipo_fk" id="id_tipo_fk">
                @foreach ($tipo as $tipo)
                    @if ($lugar->nombre_lugar == $tipo->nombre_tipo)
                        <option value="{{$tipo->id_tipo}}" selected>{{$tipo->nombre_tipo}}</option>
                    @else
                        <option value="{{$tipo->id_tipo}}">{{$tipo->nombre_tipo}}</option>
                    @endif   
                @endforeach
            </select>
            <p>Tag:</p>
            <select class="btn-outline-success" name="id_tag_fk" id="id_tag_fk">
                @foreach ($tag as $tag)
                    @if ($lugar->id_tag_fk == $tag->id_tag)
                        <option value="{{$tag->id_tag}}" selected>{{$tag->nombre_tag}}</option>
                    @else
                        <option value="{{$tag->id_tag}}">{{$tag->nombre_tag}}</option>
                    @endif   
                @endforeach
            </select>
            <br><br>
            <div>
                <input type="hidden" name="id_lugar" value="{{$lugar->id_lugar}}">
                <input class="btn btn-success" type="submit" value="Modificar">
            </div>
        </form>
    </center>
    <img src="../media/mapa.png" name="back" value="back" width="50px" height="50px">
</body>
</html>