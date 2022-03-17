<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{!! asset('css/styles_login.css') !!}">
  <link rel="shortcut icon" href="../public/media/logo2.png">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  <title>Login</title>
</head>


<a href="{{ url('')}}">
  <i class="fad fa-angle-double-left fa-3x" style="padding: 10px 10px;"></i>
</a>

<body>
  <div class="loginbox">
    <img src="../public/media/logo.png" class="avatar">
    <h1>INICIO DE SESIÓN</h1>
      <form action="{{url('login')}}" method="POST">
          @csrf
          <div class="form-group">
            <p>Email:</p>
            <div>
              <input class="inputlogin" type="text" name="email_usuario" placeholder="Introduce email..." required>
            </div>
            @error('email_usuario')
            <br>
            {{$message}}
            @enderror
          </div>
          <br>
          <div class="form-group">
            <p>Contraseña:</p>
            <div>
              <input class="inputlogin" type="password" name="contra_usuario" placeholder="Introduce contraseña..." required>
            </div>
            @error('contra_usuario')
            <br>
            {{$message}}
            @enderror
          </div>
          <br><br>
          <div class="form-group">
            <input type="submit" value="Iniciar Sesión"></input>
          </div>
      </form>
      <br>
      <a href="{{ url('register')}}">
        <p><b style="padding-right: 10px; font-size:1.7vh;" onclick="">No estás registrado? Regístrate</b></p>
      </a>
  </div>
</body>
</html>
