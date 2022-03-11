<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{!! asset('css/style_secciones.css') !!}">
    <title>Secciones Admin</title>
</head>
<body>
    <center>
        <h1>ADMINISTRADOR</h1>
        <form action="{{url('gincana')}}" method="GET">
            <button class="btn btn-primary" type="submit" name="Gincana" value="Gincana"><img src="./media/gincana.png" class="btn btn-primary" type="submit" name="gincana" value="gincana"><p>GINCANA</p></button>
        </form>
        <form action="{{url('usuarios')}}" method="GET">
            <button class="btn btn-primary" type="submit" name="usuarios" value="usuarios"><img src="./media/usuario.png" class="btn btn-primary" type="submit" name="usuarios" value="usuarios"><p>USUARIOS</p></button>
        </form>
        <form action="{{url('lugares')}}" method="GET">
            <button class="btn btn-primary" type="submit" name="lugar" value="lugar"><img src="./media/mapa.png" class="btn btn-primary" type="submit" name="lugar" value="lugar"><p>MAPA</p></button>
        </form>
    </center>
</body>
</html>