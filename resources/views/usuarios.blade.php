<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="js/ajaxUsuario.js"></script>
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="css/style.css">
    <title>Laravel Usuarios</title>
</head>
<body>
    <form action="{{url('secciones')}}" method="GET">
        <button class="btn btn-primary" type="submit" name="back" value="back">Back</button>
    </form>
    <center>
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <form id="formUpdate" method="post" onsubmit="actualizar();closeModal();return false;">
                        <h2 id="tituloUsuario"></h2>
                        <input type="hidden" name="_method" value="PUT" id="modifUsuario">
                        <span>Nombre</span>
                        <input type="text" name="nombre_usuario" id="nombreUpdate">
                        <span>Email</span>
                        <input type="text" name="email_usuario" id="email_usuario">
                        <span>Contraseña</span>
                        <input type="text" name="contra_usuario" id="contra_usuario">
                        <span>Telefono</span>
                        <input type="number" name="telf_usuario" id="telf_usuario">
                        <span>Foto</span>
                        <input type="file" name="foto_usuario" id="foto_usuario">
                        <input type="submit" value="Editar">
                        <input type="hidden" name="id" id="idUpdate">
                    </form>
                </div>
            </div>
            <br><br><br>
        <div>
            <div>
                <form class="formulario" id="formcrear" method="post" onsubmit="crear();return false;">
                    <span>Nombre</span>
                        <input type="text" name="nombre_usuario" id="nombreUpdate">
                        <span>Email</span>
                        <input type="text" name="email_usuario" id="email_usuario">
                        <span>Contraseña</span>
                        <input type="password" name="contra_usuario" id="contra_usuario">
                        <span>Telefono</span>
                        <input type="number" name="telf_usuario" id="telf_usuario">
                        <span>Foto</span>
                        <input type="file" name="foto_usuario" id="foto_usuario">
                    <br><br>
                    <input type="hidden" name="_method" value="POST" id="createUsuario">
                    <input class="btn btn-success" type="submit" value="Crear">
                </form>
                <br>
                <div id="message" style="color:rgb(0, 0, 0)"></div>
            </div>
        </div>
        <br><br>
        <div>
            <form method="post" onsubmit="return false;">
                <input type="hidden" name="_method" value="POST" id="postFiltro">
                <div class="form-outline">
                   <input type="search" id="search" name="nombre" class="form-control" placeholder="Filtrar por..." aria-label="Search" onkeyup="filtro(); return false;"/>
                </div>
             </form>
        </div>
        <div>
            <table class="table" id="table">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Grupo</th>
                    <th scope="col"></th>
                    <th scope="col" colspan="2">Acciones</th>
                </tr>
                @forelse ($usuarios as $usuario)
                <tr>
                    <td>{{$usuario->id}}</td>
                    <td>{{$usuario->nombre_usuario}}</td>
                    <td>{{$usuario->email_usuario}}</td>
                    <td>{{$usuario->telf_usuario}}</td>
                    <td><img src="./storage/usuarios/{{$usuario->foto_usuario}}" width="100px" height="100px"></td>
                    <td>{{$usuario->nombre_rol}}</td>
                    <td>{{$usuario->nombre_grupo}}</td>
                    <td>
                        <button class= "btn btn-secondary" type="submit" value="Edit" onclick="modalbox({{$usuario->id}},'{{$usuario->nombre_usuario}}','{{$usuario->email_usuario}}','{{$usuario->contra_usuario}}','{{$usuario->telf_usuario}}','{{$usuario->foto_usuario}}');return false;">Editar</button>
                    </td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="_method" value="DELETE" id="deleteUsuario">
                            <button class="btn btn-danger" type="submit" value="Delete" onclick="eliminar({{$usuario->id}}); return false;">Eliminar</button>
                         </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7">No hay registros</td></tr>
                @endforelse
            </table>
        </div>
    </center>
    <script>
                /*FI*/
        var modal = document.getElementById("myModal");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        function modalbox(id,nombre_usuario,email_usuario,contra_usuario,telf_usuario,foto_usuario){
            modal.style.display = "block";
            document.getElementById('tituloUsuario').innerHTML = "Usuario Nº "+id;
            document.getElementById('nombreUpdate').value = nombre_usuario;
            document.getElementById('email_usuario').value = email_usuario;
            document.getElementById('contra_usuario').value = contra_usuario;
            document.getElementById('telf_usuario').value = telf_usuario;
            document.getElementById('foto_usuario').value = foto_usuario;
            document.getElementById('idUpdate').value = id;
        }
        function closeModal(){
            modal.style.display = "none";
        }
        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            closeModal();
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</body>

</html>
        