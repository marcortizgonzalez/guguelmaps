<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{!! asset('css/styles_login.css') !!}">
  <title>Login</title>
</head>

<a href="{{ url('register')}}">
  <p><b style="padding-right: 10px;" onclick="">REGISTRARME</b></p>
</a>

<a href="{{ url('')}}">
  <p><b style="padding-right: 10px;" onclick="">INICIO</b></p>
</a>

<body class="login">
  <div class="row flex-cv">
    <div class="cuadro_login">
      <form action="{{url('login')}}" method="POST">
          @csrf
          <br>
          <h1>INICIO DE SESIÓN</h1>
          <br>
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
            <button class= "botonlogin" type="submit" value="register">Iniciar Sesión</button>
          </div>
      </form>
    </div>
  </div>
</body>
</html>
