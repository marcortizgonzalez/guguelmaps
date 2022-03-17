@if (!Session::get('email_usuario')||Session::get('id_rol_fk') != "1")
    <?php
        //Si la session no esta definida te redirige al login, la session se crea en el método.
        return redirect()->to('')->send();
    ?>
@endif
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="../public/media/logo2.png">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>Modificar Gincana</title>
</head>
<body>
    <div>
        <form class="back" action="{{url('gincanas')}}" method="GET">
            {{-- <button style="cursor: pointer"><img src="../media/back.png" type="submit" name="back" value="back" width="50px" height="50px"></button> --}}
            <button><i class="fas fa-long-arrow-alt-left fa-3x" style="cursor: pointer; padding-left:15px"></i></button>
        </form>
    </div>

    <div class="form-body">
        <div class="row">
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>Modificar Gincana</h3>
                        <form class="cuadro_login" action="{{url('modificarGincana')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            {{method_field('PUT')}}

                            <div class="col-md-12">
                                <p>Nombre de la gincana:</p>
                                <input class="form-control" type="text" name="nombre_gincana" value="{{$gincana->nombre_gincana}}">
                            </div>
                            <div class="col-md-12">
                                <p>Pista 1:</p>
                                <input class="form-control" type="text" name="pista1_gincana" value="{{$gincana->pista1_gincana}}">
                            </div>
                            <div class="col-md-12">
                                <p>Punto 1:</p>
                                <select class="form-control" name="id_punto1_fk" id="id_punto1_fk">
                                    @foreach ($lugar as $lugar)
                                        @if ($gincana->id_punto1_fk == $lugar->id_lugar)
                                            <option value="{{$lugar->id_lugar}}" selected>{{$lugar->nombre_lugar}}</option>
                                        @else
                                            <option value="{{$lugar->id_lugar}}">{{$lugar->nombre_lugar}}</option>
                                        @endif   
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <p>Pista 2:</p>
                                <input class="form-control" type="text" name="pista2_gincana" value="{{$gincana->pista2_gincana}}">
                            </div>
                            <div class="col-md-12">
                                <p>Punto 2:</p>
                                <select class="form-control" name="id_punto2_fk" id="id_punto2_fk">
                                    @foreach ($lugar2 as $lugar)
                                        @if ($gincana->id_punto2_fk == $lugar->id_lugar)
                                            <option value="{{$lugar->id_lugar}}" selected>{{$lugar->nombre_lugar}}</option>
                                        @else
                                            <option value="{{$lugar->id_lugar}}">{{$lugar->nombre_lugar}}</option>
                                        @endif   
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <p>Pista 3:</p>
                                <input class="form-control" type="text" name="pista3_gincana" value="{{$gincana->pista3_gincana}}">
                            </div>
                            <div class="col-md-12">
                                <p>Punto 3:</p>
                                <select class="form-control" name="id_punto3_fk" id="id_punto3_fk">
                                    @foreach ($lugar3 as $lugar)
                                        @if ($gincana->id_punto3_fk == $lugar->id_lugar)
                                            <option value="{{$lugar->id_lugar}}" selected>{{$lugar->nombre_lugar}}</option>
                                        @else
                                            <option value="{{$lugar->id_lugar}}">{{$lugar->nombre_lugar}}</option>
                                        @endif   
                                    @endforeach
                                </select>
                            </div>

                            <br><br>

                            <div class="form-button mt-3">
                                <input type="hidden" name="id_gincana" value="{{$gincana->id_gincana}}">
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
    <img src="../media/gincana.png" name="back" value="back" width="50px" height="50px">
</body>
</html>