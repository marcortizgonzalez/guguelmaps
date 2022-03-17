<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>Modificar Lugar</title>
</head>
<body>
    <div>
        <form class="back" action="{{url('lugares')}}" method="GET">
            {{-- <button style="cursor: pointer"><img src="../media/back.png" type="submit" name="back" value="back" width="50px" height="50px"></button> --}}
            <button><i class="fas fa-long-arrow-alt-left fa-3x" style="cursor: pointer; padding-left:15px"></i></button>
        </form>
    </div>

    <div class="form-body">
        <div class="row">
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>Modificar Lugar</h3>
                        <form class="cuadro_login" action="{{url('modificarLugar')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            {{method_field('PUT')}}

                            <div class="col-md-12">
                                <p>Nombre:</p>
                                <input class="btn-outline-success" type="text" name="nombre_lugar" value="{{$lugar->nombre_lugar}}">
                            </div>
                            <div class="col-md-12">
                                <p>Dirección:</p>
                                <input class="btn-outline-success" type="text" name="direccion_lugar" value="{{$lugar->direccion_lugar}}">
                            </div>
                            <div class="col-md-12">
                                <p>Coordenadas:</p>
                                <input class="btn-outline-success" type="text" name="coordenadas_lugar" value="{{$lugar->coordenadas_lugar}}">
                            </div>
                            <div class="col-md-12">
                                <p>Descripción:</p>
                                <input class="btn-outline-success" type="text" name="descripcion_lugar" value="{{$lugar->descripcion_lugar}}">
                            </div>
                            <div class="col-md-12">
                                <p>Foto:</p>
                                <input type="file" name="foto_lugar" value="">
                            </div>
                            <div class="col-md-12">
                                <p>Tipo:</p>
                                <select class="btn-outline-success" name="id_tipo_fk" id="id_tipo_fk">
                                    @foreach ($tipo as $tipo)
                                        @if ($lugar->id_tipo_fk == $tipo->id_tipo)
                                            <option value="{{$tipo->id_tipo}}" selected>{{$tipo->nombre_tipo}}</option>
                                        @else
                                            <option value="{{$tipo->id_tipo}}">{{$tipo->nombre_tipo}}</option>
                                        @endif   
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
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
                            </div>

                            <br><br>
                            
                            <div class="form-button mt-3">
                                <input type="hidden" name="id_lugar" value="{{$lugar->id_lugar}}">
                                <div>
                                    <input class="btn-primary" type="submit" value="Modificar">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <img src="../media/mapa.png" name="back" value="back" width="50px" height="50px">
</body>
</html>