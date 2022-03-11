<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="js/ajaxLugar.js"></script>
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="css/style.css">
    <title>Laravel Lugares</title>
</head>
<body>
    <div>
        <form class="back" action="{{url('secciones')}}" method="GET">
            <button><img src="./media/back.png" type="submit" name="back" value="back" width="50px" height="50px"></button>
        </form>
        <form class="add" action="{{url('crearLugar')}}" method="GET">
            <button><img src="./media/+.png" type="submit" name="back" value="back" width="50px" height="50px"></button>
        </form>
    </div>
    <center>
            {{-- <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <form id="formUpdate" method="post" onsubmit="actualizar();closeModal();return false;">
                        <h2 id="tituloLugar"></h2>
                        <input type="hidden" name="_method" value="PUT" id="modifLugar">
                        <span>Nombre</span>
                        <input type="text" name="nombre_lugar" id="nombreUpdate">
                        <span>coordenadascación</span>
                        <input type="text" name="coordenadas_lugar" id="coordenadas_lugar">
                        <span>Telefono</span>
                        <input type="number" name="telf_lugar" id="telf_lugar">
                        <span>Descripción</span>
                        <input type="text" name="descripcion_lugar" id="descripcion_lugar">
                        <span>Foto</span>
                        <input type="file" name="foto_lugar" id="foto_lugar">
                        <span>Tipo</span>
                        <input type="select" name="id_tipo_fk" id="id_tipo_fk">
                        <input type="submit" value="Editar">
                        <input type="hidden" name="id" id="idUpdate">
                    </form>
                </div>
            </div> --}}
            <br>
        <div>
            <form method="post" onsubmit="return false;">
                <input type="hidden" name="_method" value="POST" id="postFiltro">
                <div class="form-outline">
                   {{-- <input type="search" id="search" name="nombre" class="form-control" placeholder="Filtrar por..." aria-label="Search" onkeyup="filtro(); return false;"/> --}}
                </div>
             </form>
        </div>
        <div class=alert id='message'></div>
        <div>
            <table class="table" id="table">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Coordenadas</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Tag</th>
                    <th scope="col" colspan="2">Acciones</th>
                </tr>
                @forelse ($lugares as $lugar)
                <tr>
                    <td>{{$lugar->id_lugar}}</td>
                    <td>{{$lugar->nombre_lugar}}</td>
                    <td>{{$lugar->coordenadas_lugar}}</td>
                    <td>{{$lugar->direccion_lugar}}</td>
                    <td>{{$lugar->telf_lugar}}</td>
                    <td>{{$lugar->descripcion_lugar}}</td>
                    <td><img src="./storage/lugar/{{$lugar->foto_lugar}}" width="150px" height="150px"></td>
                    <td>{{$lugar->nombre_tipo}}</td>
                    <td>{{$lugar->nombre_tag}}</td>
                    <td><form action="{{url('modificarLugar/'.$lugar->id_lugar)}}" method="GET">
                        <button class="btn btn-secondary" type="submit" name="Modificar" value="Modificar">Editar</button>
                    </form></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="_method" value="DELETE" id="deleteLugar">
                            <button class="btn btn-danger" type="submit" value="Delete" onclick="eliminar({{$lugar->id_lugar}}); return false;">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7">No hay registros</td></tr>
                @endforelse
            </table>
        </div>
    </center>
    {{-- <script>
                /*FI*/
        var modal = document.getElementById("myModal");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        function modalbox(id,nombre_lugar,coordenadas_lugar,telf_lugar,descripcion_lugar,foto_lugar,id_tipo_fk){
            modal.style.display = "block";
            document.getElementById('tituloLugar').innerHTML = "Lugar Nº "+id;
            document.getElementById('nombreUpdate').value = nombre_lugar;
            document.getElementById('coordenadas_lugar').value = coordenadas_lugar;
            document.getElementById('telf_lugar').value = telf_lugar;
            document.getElementById('descripcion_lugar').value = descripcion_lugar;
            document.getElementById('foto_lugar').value = foto_lugar;
            document.getElementById('id_tipo_fk').value = id_tipo_fk;
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
    </script> --}}
    <img src="./media/mapa.png" name="back" value="back" width="50px" height="50px">
</body>

</html>
        