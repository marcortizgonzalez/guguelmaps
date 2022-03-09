<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Center the map</title>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/leaflet.esri.geocoder/2.1.0/esri-leaflet-geocoder.css">
    <script src="https://cdn.jsdelivr.net/leaflet.esri.geocoder/2.1.0/esri-leaflet-geocoder.js"></script>
    <script src="js/code.js"></script>
    <!-- Load Leaflet from CDN -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js" integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==" crossorigin=""></script>

    <!-- Load Esri Leaflet from CDN -->
    <script src="https://unpkg.com/esri-leaflet@2.3.2/dist/esri-leaflet.js" integrity="sha512-6LVib9wGnqVKIClCduEwsCub7iauLXpwrd5njR2J507m3A2a4HXJDLMiSZzjcksag3UluIfuW1KzuWVI5n/cuQ==" crossorigin=""></script>
    <script src="js/code.js"></script>

</head>
<body>
  <center>
  <div id="myModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <form id="formLogin" method="post" onsubmit="login();closeModal();return false;">
        @csrf
          {{method_field('POST')}}
        <h1>LOGIN USER</h1>
        <br>
        <p>Usuario:</p>
          <div>
            <input class="inputlogin" type="text" name="email_usuario" id="email_usuario" placeholder="Introduce tu email">
          </div>
        <br>
        <p>Contraseña:</p>
          <div>
            <input class="inputlogin" type="password" name="contra_usuario" id="contra_usuario" placeholder="Introduce la contraseña">
          </div>
        <br><br>
        <button class="botonlogin" type="submit" value="Login">ENTRAR</button>
      </form>
    </div>
  </div>
</center>
    <div id="map"></div>
    <div class="login flex-cv">
        @if (Session::get('nombre_admin') || Session::get('nombre_cliente'))
        <a href="{{url('logout')}}">
            <button type="button" >Logout</button>
        </a>
        @else
        <a href="{{url('secciones')}}" {{-- onclick="modalbox({{$usuario->email_usuario}},'{{$usuario->contra_usuario}}');return false;" --}}>
            <img src="storage/usuarios/default.png" height="50px" width="50px">
        </a>
        @endif
    </div>
    <script>
        /*FI*/
        var modal = document.getElementById("myModal");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        function modalbox(email_usuario,contra_usuario){
          modal.style.display = "block";
          document.getElementById('email_usuario').value = email_usuario;
          document.getElementById('contra_usuario').value = contra_usuario;
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