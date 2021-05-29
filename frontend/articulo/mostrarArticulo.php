<?php require_once('../header/header.php') ?>
<?php require_once('../nav/nav.php') ?>
<?php 
    require '../../backend/bd/DAOarticulo.php';

    $conexion = conectarBD(true);
    $idUsuario = "";
    if(isset($_SESSION["id"])){
        $idUsuario = $_SESSION["id"];
    }

    $rol = "invitado";
    if(isset($_SESSION["rol"])){
        $rol = $_SESSION["rol"];
    }
    
    $tipo = $_GET["tipo"];
    $idArticulo = $_GET["id"];

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../index/index.css">
        <link rel="stylesheet" href="likes.css">
        <link rel="stylesheet" href="../migasPan/migasPan.css">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>
    <body class="index">
        <div class="contenedor">
            <ul id="migasPan">
                <li><a href="../index/index.php"> Inicio </a></li>
                <li><a href="../categorias/categorias.php"> Categorías </a></li>
                <li><a href="articulo.php?tipo=<?php echo $tipo; ?>"> Artículos </a></li>
                <li><a href=""> Nombre Articulo </a></li> <!-- CAMBIAR POR NOMBRE DEL ARTICULO ACTUAL -->
            </ul>
            <div>
                <?php if($rol!="invitado"){ ?>
                <div class="likes">
                    <label for="meGusta" class="verde"><i class="fas fa-thumbs-up "></i></label><span class="nLikes"> &nbsp; &nbsp;</span>
                    <input type="radio" class="like meGusta" name="like" id="meGusta" data-idArticulo="<?php echo $idArticulo;?>" data-valor="1">
                    <label for="noMeGusta" class="rojo"><i class="fas fa-thumbs-down"></i></label><span class="nDislikes"> &nbsp; &nbsp;</span>
                    <input type="radio" class="like noMeGusta" name="like" id="noMeGusta" data-idArticulo="<?php echo $idArticulo;?>" data-valor="-1">
                    <label for="borrarLike" class="borrarLike"><i class="fas fa-ban"></i></label>
                    <input class="like borrarLike" name="borrarLike" id="borrarLike" data-idArticulo="<?php echo $idArticulo;?>" data-valor="0">
                </div>
                <?php } ?>
                <form id="comentarioForm">
                    <textarea name="comentario" id="comentario" minlength="0" maxlength="1000" cols="90" rows="3"></textarea><?php if($rol!="invitado"){ ?><button class="botonComentario" name="comentario" id="comentario" data-idArticulo = "<?php echo $idArticulo;?>" data-rol="<?php echo $_SESSION["rol"]; ?>" data-idUsuario="<?php echo $_SESSION["id"]; ?>">Comentar</button></form><div id="verComentario"></div><?php } ?>
                    <?php if($rol=="invitado"){ ?><button type="hidden" class="botonComentario" name="comentario" id="comentario" data-idArticulo = "<?php echo $idArticulo;?>"></button><div id="verComentario2"></div><?php } ?> <br>
            </div>
        </div>
        <?php require_once('../footer/footer.php') ?>   
    </body>
</html>
<script src="articulo.js" type="text/javascript"></script>
<script src="likes.js" type="text/javascript"></script>