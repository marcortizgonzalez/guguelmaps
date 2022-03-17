<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>Modificar Tag</title>
</head>
<body>
    <div>
        <form class="back" action="{{url('tags')}}" method="GET">
            {{-- <button style="cursor: pointer"><img src="../media/back.png" type="submit" name="back" value="back" width="50px" height="50px"></button> --}}
            <button><i class="fas fa-long-arrow-alt-left fa-3x" style="cursor: pointer; padding-left:15px"></i></button>
        </form>
    </div>

    <div class="form-body">
        <div class="row">
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>Modificar Tag</h3>
                        <form class="cuadro_login" action="{{url('modificarTag')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            {{method_field('PUT')}}

                            <div class="col-md-12">
                                <p>Nombre:</p>
                                <input class="form-control" type="text" name="nombre_tag" value="{{$tags->nombre_tag}}">
                            </div>
                            <div class="col-md-12">
                                <p>Icono FontAwesome:</p>
                                <input class="form-control" type="text" name="icono_tag" value="{{$tags->icono_tag}}">
                            </div>

                            <br><br>

                            <div class="form-button mt-3">
                                <input type="hidden" name="id_tag" value="{{$tags->id_tag}}">
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
    <img src="../media/tag.png" name="back" value="back" width="50px" height="50px">
</body>
</html>