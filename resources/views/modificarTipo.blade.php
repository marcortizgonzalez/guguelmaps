<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>Modificar Tipo</title>
</head>
<body>
    <div>
        <form class="back" action="{{url('tipos')}}" method="GET">
            {{-- <button style="cursor: pointer"><img src="../media/back.png" type="submit" name="back" value="back" width="50px" height="50px"></button> --}}
            <button><i class="fas fa-long-arrow-alt-left fa-3x" style="cursor: pointer; padding-left:15px"></i></button>
        </form>
    </div>

    <div class="form-body">
        <div class="row">
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>Modificar Tipo de sitio</h3>
                        <form class="cuadro_login" action="{{url('modificarTipo')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            {{method_field('PUT')}}

                            <div class="col-md-12">
                                <p>Nombre:</p>
                                <input class="form-control" type="text" name="nombre_tipo" value="{{$tipos->nombre_tipo}}">
                            </div>
                            <div class="col-md-12">
                                <p>Icono FontAwesome:</p>
                                <input class="form-control" type="text" name="icono_tipo" value="{{$tipos->icono_tipo}}">
                            </div>

                            <br><br>

                            <div class="form-button mt-3">
                                <input type="hidden" name="id_tipo" value="{{$tipos->id_tipo}}">
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
    <img src="../media/lugares.png" name="back" value="back" width="50px" height="50px">
</body>
</html>