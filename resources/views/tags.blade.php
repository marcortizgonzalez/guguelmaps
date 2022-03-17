<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="js/ajaxTag.js"></script>
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>Laravel Tags</title>
</head>
<body>
    <div class="white">
        <br>
        <form class="back" action="{{url('secciones')}}" method="GET">
            {{-- <button style="cursor: pointer"><img src="../media/back.png" type="submit" name="back" value="back" width="50px" height="50px"></button> --}}
            <button><i class="fas fa-long-arrow-alt-left fa-3x" style="cursor: pointer; padding-left:15px"></i></button>
        </form>
        <form class="add" action="{{url('crearTag')}}" method="GET">
            {{-- <button><img src="./media/+.png" type="submit" name="back" value="back" width="50px" height="50px"></button> --}}
            <button><i class="far fa-plus fa-3x" style="cursor: pointer; padding-right:15px"></i></button>
        </form>

        <br>
        <div class="titulo">
            <h1>TAGS</h1>
        </div>
    </div>
    
    <center>
            <br>
        <div>
            <table class="table" id="table">

            </table>
        </div>
    </center>

    <img src="./media/tag.png" name="back" value="back" width="50px" height="50px" style="padding: 0px 0px 10px 10px">
</body>

</html>
        