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
    <link rel="stylesheet" href="{!! asset('css/style_secciones.css') !!}">
    <link rel="shortcut icon" href="../public/media/logo2.png">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>Secciones Admin</title>
</head>
<body>  

    <div class="header">
        <a href="{{url('logout')}}"><img class="logo" src="./media/logo2.png" alt="logo"></a>
        
        <div >
            <a class="logout" href="{{ url('logout')}}"><i class="fad fa-sign-out fa-2x"></i></a>
        </div>

        <br>
        <center>
            <h1>ADMIN CONTROL PANEL</h1>
        </center>

        <br>
        <marquee behavior="scroll" direction="right" scrolldelay="1" class="bienvenido">Bienvenido <?php echo Session::get('email_usuario'); ?></marquee>
        <br>
        <br>
  </div>


    <div class="one-column">
        <div class="four-column">
            <form action="{{url('gincanas')}}" method="GET">
                <button class="btn btn-1" type="submit" name="gincana" value="gincana" style="cursor: pointer"><img src="./media/gincana.png" class="btn btn-primary" type="submit" name="gincana" value="gincana"><p>GINCANA</p></button>
            </form>
        </div>
        <div class="four-column">
            <form action="{{url('usuarios')}}" method="GET">
                <button class="btn btn-2" type="submit" name="usuarios" value="usuarios" style="cursor: pointer"><img src="./media/usuario.png" class="btn btn-primary" type="submit" name="usuarios" value="usuarios"><p>USUARIOS</p></button>
            </form>
        </div>
        <div class="four-column">
            <form action="{{url('lugares')}}" method="GET">
                <button class="btn btn-3" type="submit" name="lugar" value="lugar" style="cursor: pointer"><img src="./media/mapa.png" class="btn btn-primary" type="submit" name="lugar" value="lugar"><p>MAPA</p></button>
            </form>
        </div>
        <div class="four-column">
            <form action="{{url('tags')}}" method="GET">
                <button class="btn btn-4" type="submit" name="tag" value="tag" style="cursor: pointer"><img src="./media/tag.png" class="btn btn-primary" type="submit" name="tag" value="tag"><p>TAGS</p></button>
            </form>
        </div>
        <div class="four-column">
            <form action="{{url('tipos')}}" method="GET">
                <button class="btn btn-5" type="submit" name="tipo" value="tipo" style="cursor: pointer"><img src="./media/lugares.png" class="btn btn-primary" type="submit" name="tipo" value="tipo"><p>TIPOS DE SITIO</p></button>
            </form>
        </div>
    </div>

</body>
</html>