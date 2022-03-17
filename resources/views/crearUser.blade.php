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
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="../public/media/logo2.png">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>Crear Usuario</title>
</head>
<body>
    <div>
        <form class="back" action="{{url('usuarios')}}" method="GET">
            {{-- <button style="cursor: pointer"><img src="../media/back.png" type="submit" name="back" value="back" width="50px" height="50px"></button> --}}
            <button><i class="fas fa-long-arrow-alt-left fa-3x" style="cursor: pointer; padding-left:15px"></i></button>
        </form>
    </div>

    <div class="form-body">
        <div class="row">
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>Crear Usuario</h3>
                        <form action="{{url('crearUser')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            {{method_field('POST')}}
                            <div class="col-md-12">
                                <p>Nombre:</p>
                                    <input class="form-control" type="text" name="nombre_usuario" required>
                                    @error('nombre_usuario')
                                        <br>
                                        {{$message}}
                                    @enderror
                            </div>

                            <div class="col-md-12">
                                <p>Email:</p>
                                    <input class="form-control" type="text" name="email_usuario" required>
                                    @error('email_usuario')
                                        <br>
                                        {{$message}}
                                    @enderror
                            </div>

                            <div class="col-md-12">
                                <p>Contraseña:</p>
                                    <input class="form-control" type="password" name="contra_usuario" required>
                                    @error('contra_usuario')
                                        <br>
                                        {{$message}}
                                    @enderror
                            </div>
                            
                            <div class="col-md-12">
                                <p>Telf:</p>
                                    <input class="form-control" type="number" name="telf_usuario" required>
                                    @error('telf_usuario')
                                        <br>
                                        {{$message}}
                                    @enderror
                            </div>

                            <div class="col-md-12">
                                <p>Foto:</p>
                                    <input class="form-control" type="file" name="foto_usuario" >
                                    @error('foto_usuario')
                                        <br>
                                        {{$message}}
                                    @enderror
                            </div>

                            <div class="col-md-12">
                                <p>Rol:</p>
                                    <select class="form-control" name="id_rol_fk" id="id_rol_fk" required>
                                        <option value="2" selected disabled>Seleccionar rol...</option>
                                        <option value="1">Admin</option>
                                        <option value="2">Cliente</option>
                                    </select>
                                    @error('id_rol_fk')
                                        <br>
                                        {{$message}}
                                    @enderror
                            </div>
                            
                            <br><br>

                            <div class="form-button mt-3">
                                <div>
                                    <input class="btn-primary" type="submit" value="Crear">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <img src="./media/usuario.png" name="back" value="back" width="50px" height="50px">
</body>
</html>