<?php require_once('../header/header.php') ?>
<?php require_once('../nav/nav.php') ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../index/css/index.css">
        <link rel="stylesheet" href="css/calendario.css">
        <link rel="stylesheet" href="../migasPan/css/migasPan.css">
    </head>
    <body class="index">
        <div class="contenedorCalendario">
            <ul id="migasPan">
                <li><a href="../index/index.php"> Inicio </a></li>
                <li><a href=""> Calendario </a></li>
            </ul>
            <div class="imagenesCalendario">
                <div class="contenedorImagen">
                    <img class="imagenCalendario" src="calendario1.png" alt="calendario1">
                </div>

                <div class="contenedorImagen">
                    <img class="imagenCalendario" src="calendario2.png" alt="calendario2">
                </div>  

                <div class="contenedorImagen">
                    <img class="imagenCalendario" src="calendario3.png" alt="calendario3">
                </div> 

                <div class="contenedorImagen">
                    <img class="imagenCalendario" src="calendario4.png" alt="calendario4">
                </div>  

                <div class="contenedorImagen">
                    <img class="imagenCalendario" src="calendario5.png" alt="calendario5">
                </div>
            </div>
        </div>  
        <?php require_once('../footer/footer.php') ?>       
    </body>
</html>