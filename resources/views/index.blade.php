<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- iconos FontAwesome-->
    <script type="text/javascript" src="../public/js/iconos_g.js"></script>
    <!--JQUERY-->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> -->
    <script type="text/javascript" src="../public/js/jquery.js"></script>
    <!--COOKIES-->
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2.2.0/src/js.cookie.min.js"></script>
    <!-- sweetAlert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- LEAFLET -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <!-- owl carousel -->
    <script src="../public/js/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="../public/css/owl.carousel.min.css">
    <!-- ||||||||||CUSTOM||||||||||| -->
    <script src="../public/js/js.js"></script>
    <script src="../public/js/modal.js"></script>
    <link rel="stylesheet" href="../public/css/styles.css">

    <title>Guguel Maps</title>
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
</head>
<!-- pagina principal -->

<body class="main-page">
    <!-- div donde se encuantra todo el mesnu.. tags, usuario... El contenido que se superpone con el mapa -->
    <div class="hud">
        <div class="content-hud">
            <!-- menu superior, aqui encontramos los tags y añadir tags -->

        </div>

    </div>

    <div class="top-menu">
        <div class="content_top-menu">

            <div class="main-tags">
                <div class="content-tags">
                    <!-- Cada tags debe de venir de un foreach -->
                    @foreach($tipolist as $tipo)
                    <div class="tag">
                        <!-- el <i> debe ser el icono y el span el nombre del tag -->
                        <i class="{{$tipo->icono_tipo}}"></i><span class="txt-tag">&nbsp{{$tipo->nombre_tipo}}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="user-tags">
                <div class="content-tags">
                    <!-- Cada tags debe de venir de un foreach -->
                    @foreach($taglist as $tag)
                    <div class="tag">
                        <!-- el <i> debe ser el icono y el span el nombre del tag -->
                        <i class="{{$tag->icono_tag}}"></i><span class="txt-tag">&nbsp{{$tag->nombre_tag}}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- Para crear un tag personal -->
            <div class="create-tag"><span><i class="fad fa-plus"></i></span></div>
        </div>
    </div>
    <!-- Mapa -->
    <div id="map"></div>

    <div class="bottom-menu">
        <div class="content_bottom-menu">
            <!-- boton para hacer logout -->
            <div class="btn-logout"><span><i class="fad fa-sign-out"></i></span></div>
            <!-- Boton para unirse a grupo o crear grupo -->
            <div class="btn-group">
                <button class="btn-grupo">
                    <span>Unirme a grupo</span>
                </button>
            </div>
            <!-- boton para iniciar sesion o para mostrar los datos de la sesion -->
            <div class="user-profile">
                <div class="content-profile">
                    <div class="userdata">
                        <!-- nombre del usuario -->
                        <div class="user-name">Marc Ortiz</div>
                        <!-- grupo del usuario -->
                        <div class="user-group">Los panitas</div>
                    </div>
                    <div class="user-avatar">
                        <!-- foto del usuario -->
                        <img src="../public/media\avatar.png" alt="Avatar">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>