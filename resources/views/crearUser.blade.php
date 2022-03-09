<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Crear Usuario</title>
</head>
<body>
    <div>
        <form class="back" action="{{url('usuarios')}}" method="GET">
            <button><img src="./storage/back.png" type="submit" name="back" value="back" width="50px" height="50px"></button>
        </form>
    </div>
    <center>
        <form class="cuadro_login" action="{{url('crearUser')}}" method="post" enctype="multipart/form-data">
            @csrf
            {{method_field('POST')}}
            <p>Nombre:</p>
                <input class="btn-outline-success" type="text" name="nombre_usuario">
                @error('nombre_usuario')
                    <br>
                    {{$message}}
                @enderror
            <p>Email:</p>
                <input class="btn-outline-success" type="text" name="email_usuario">
                @error('email_usuario')
                    <br>
                    {{$message}}
                @enderror
            <p>contraseña:</p>
                <input class="btn-outline-success" type="text" name="contra_usuario">
                @error('contra_usuario')
                    <br>
                    {{$message}}
                @enderror
            <p>Telf:</p>
                <input class="btn-outline-success" type="number" name="telf_usuario">
                @error('telf_usuario')
                    <br>
                    {{$message}}
                @enderror
            <p>Foto:</p>
                <input type="file" name="foto_usuario">
                @error('foto_usuario')
                    <br>
                    {{$message}}
                @enderror
            <p>Rol:</p>
                <select class="btn-outline-success" name="id_rol_fk" id="id_rol_fk">
                    <option value="" selected ></option>
                    <option value="1">Admin</option>
                    <option value="2">Cliente</option>
                </select>
                @error('id_rol_fk')
                    <br>
                    {{$message}}
                @enderror
            <br><br>
            <div>
                <input type="submit" value="Crear">
            </div>
        </form>
    </center>
    <img src="./storage/usuario.png" name="back" value="back" width="50px" height="50px">
</body>
</html>