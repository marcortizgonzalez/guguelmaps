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
            <br>
        <div>
            <table class="table" id="table">
    
            </table>
        </div>
    </center>
   
    <img src="./media/mapa.png" name="back" value="back" width="50px" height="50px">
</body>

</html>
        