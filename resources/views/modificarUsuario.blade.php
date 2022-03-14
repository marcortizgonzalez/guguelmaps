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
        <form class="back" action="{{url('usuarios')}}" method="GET">
            <button><img src="../media/back.png" type="submit" name="back" value="back" width="50px" height="50px"></button>
        </form>
    </div>
    <center>
        <form class="cuadro_login" action="{{url('modificarUsuario')}}" method="post" enctype="multipart/form-data">
            @csrf
            {{method_field('PUT')}}
            <p>Nombre:</p>
            <input class="btn-outline-success" type="text" name="nombre_usuario" value="{{$usuario->nombre_usuario}}">
            <p>Email:</p>
            <input class="btn-outline-success" type="text" name="email_usuario" value="{{$usuario->email_usuario}}">
            <p>Pass:</p>
            <input class="btn-outline-success" type="text" name="contra_usuario" value="{{$usuario->contra_usuario}}">
            <p>Telf:</p>
            <input class="btn-outline-success" type="number" name="telf_usuario" value="{{$usuario->telf_usuario}}">
            <p>Foto:</p>
            <input type="file" name="foto_usuario" value="{{$usuario->foto_usuario}}">
            <p>Rol</p>
            <select class="btn-outline-success" name="id_rol_fk" id="id_rol_fk">
                @foreach ($rol as $rol)
                    @if ($usuario->id_rol_fk == $rol->id_rol)
                        <option value="{{$rol->id_rol}}" selected>{{$rol->nombre_rol}}</option>
                    @else
                        <option value="{{$rol->id_rol}}">{{$rol->nombre_rol}}</option>
                    @endif   
                @endforeach
            </select>
            <br><br>
            <div>
                <input type="hidden" name="id_usuario" value="{{$usuario->id_usuario}}">
                <input class="btn btn-success" type="submit" value="Modificar">
            </div>
        </form>
    </center>
    <img src="../media/usuario.png" name="back" value="back" width="50px" height="50px">
</body>
</html>