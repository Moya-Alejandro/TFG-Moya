<?php require_once('../header/header.php'); ?>
<?php require_once('../nav/nav.php'); ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="categorias.css">
        <link rel="stylesheet" href="../index/index.css">
        <link rel="stylesheet" href="../migasPan/migasPan.css">
    </head>
    <body class="index">
        <ul id="migasPan">
            <li><a href="../index/index.php"> Inicio </a></li>
            <li><a href=""> Categorías </a></li>
        </ul>
        <div class="contenedorPrincipal">
            <div class="contenedor efectoContenedor">
                <a href="../articulo/articulo.php?tipo=pistola">
                    <h5>Pistolas</h5> 
                    <img src="../img/pistola.jpg" alt="pistolaImg">
                </a>
            </div>
            <div class="contenedor efectoContenedor">
                <a href="../articulo/articulo.php?tipo=carabina">
                    <h5>Carabinas</h5> 
                    <img src="../img/carabina.jpg" alt="carabinaImg">
                </a>
            </div>
            <div class="contenedor efectoContenedor">
                <a href="../articulo/articulo.php?tipo=municion">
                    <h5>Munición</h5>
                    <img src="../img/municion.jpg" alt="municionImg">
                </a>
            </div>
            <div class="contenedor efectoContenedor">
                <a href="../articulo/articulo.php?tipo=accesorios">
                    <h5>Accesorios</h5>
                    <img src="../img/accesorios.jpg" alt="accesoriosImg">
                </a>
            </div>
        </div>
        <?php require_once('../footer/footer.php') ?>      
    </body>
</html>