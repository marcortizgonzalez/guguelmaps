<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{!! asset('css/styles_register.css') !!}">
    <link rel="shortcut icon" href="{!! asset('media/logo2.png') !!}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>Registro</title>

</head>

<a href="{{ url('')}}">
    <i class="fad fa-angle-double-left fa-3x" style="padding: 10px 10px;"></i>
  </a>


  <body>
    <div class="loginbox">
      <img src="../public/media/logo.png" class="avatar">
      <h1>REGISTRO</h1>
        <form action="{{url('registerPost')}}" method="post" enctype="multipart/form-data">
            @csrf
            {{method_field('POST')}}

            <div class="form-group">
                <p>Nombre:</p>
                <input class="inputlogin" type="text" name="nombre_usuario" id="nombre_usuario" placeholder="Introduce nombre..." required>
                @error('nombre_usuario')
                <br>
                {{$message}}
                @enderror
            </div>
            <br>
            <div class="form-group">
                <p>Email:</p>
                <input class="inputlogin" type="email" name="email_usuario" id="email_usuario" placeholder="Introduce email..." required>
                @error('email_usuario')
                <br>
                {{$message}}
                @enderror
            </div>
            <br>
            <div class="form-group">
                <p>Contraseña:</p>
                <input class="inputlogin" type="password" name="contra_usuario" id="contra_usuario" placeholder="Introduce contraseña..." required>
                @error('contra_usuario')
                <br>
                {{$message}}
                @enderror
            </div>
            <br>
            <div class="form-group">
                <p>Telf:</p>
                <input class="inputlogin" type="number" name="telf_usuario" id="telf_usuario" placeholder="Introduce teléfono..." required>
                @error('telf_usuario')
                <br>
                {{$message}}
                @enderror
            </div>
            <br>
            <div class="form-group">
                <p>Foto:</p>
                <input type="file" name="foto_usuario" id="foto_usuario" required>
                @error('foto_usuario')
                <br>
                {{$message}}
                @enderror
            </div>
            <br>
            <div class="form-group">
                <input class= "botonlogin" type="submit" value="Registrarme">
            </div>
        </form>
        <br>
        <a href="{{ url('login')}}">
            <p><b style="padding-right: 10px; font-size:1.7vh;" onclick="">Ya tienes cuenta? Inicia sesión</b></p>
        </a>
    </div>
</body>
</html>