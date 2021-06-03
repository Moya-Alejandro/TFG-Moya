<?php require_once('../header/header.php') ?>
<?php require_once('../nav/nav.php') ?>
<?php 
    //Llamamos a los archivos que contienen funciones de la base de datos para poder utilizar sus funciones
    require '../../backend/bd/DAOarticulo.php';
    
    //Iniciamos la variable idUsuario vacia y en caso de que exista cambiaremos su valor
    $idUsuario = "";
    if(isset($_SESSION["id"])){
        $idUsuario = $_SESSION["id"];
    }

    //Iniciamos la variable rol como invitado y en caso de que exista cambiaremos su valor
    $rol = "invitado";
    if(isset($_SESSION["rol"])){
        $rol = $_SESSION["rol"];
    }
    
    //Guardamos en una variable la idArticulo que recibimos desde Panel articulo
    $tipo = $_GET["tipo"];
    $idArticulo = $_GET["id"];

    //Realizamos la conexión a la base de datos y guardamos en variables la consulta de la base de datos
    $conexion = conectarBD(true);
    $infoArticulo = mostrarArticuloId($conexion,$idArticulo);
    $fila = mysqli_fetch_assoc ($infoArticulo);
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../index/css/index.css">
        <link rel="stylesheet" href="css/likes.css">
        <link rel="stylesheet" href="css/mostrarArticulo.css">
        <link rel="stylesheet" href="../migasPan/css/migasPan.css">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>
    <body class="index">
        <div class="cuerpo">
            <div class="contenedorMostrarArticulo">
                <ul id="migasPan">
                    <li><a href="../index/index.php"> Inicio </a></li>
                    <li><a href="../categorias/categorias.php"> Categorías </a></li>
                    <li><a href="articulo.php?tipo=<?php echo $tipo; ?>"> Artículos </a></li>
                    <li><a href=""> <?php echo $fila['nArticulo']?> </a></li>
                </ul>
                <div class="contInfo">
                    <!--Mostramos la información del articulo seleccionado-->
                    <div class="contImg">
                        <div class="contImgMostrarArticulo">
                            <img class="imgMostrarArticulo" src="../<?php echo $fila['foto']?>" alt="imagenArticulo">
                        </div>
                    </div>
                    <div class="contInformacionArt">
                        <div class="nArticuloInfo">
                            <?php echo $fila['nArticulo']?>
                        </div>
                        <div class="precioInfo">
                            <?php echo $fila['precio']?>€<span class="stockDisponible"><?php if($fila['stock'] == 0){ echo "No disponible"; } else{ echo "Disponibles: ".$fila['stock']; }?> </span>
                        </div>
                        <?php if($rol != "invitado"){ ?>
                            <div class="botonComprar"><button <?php if($fila['stock'] == 0){ echo "onclick='stockVacio()'"; } ?> class="enviar" id="insertarCarrito" name="insertarCarrito" data-tipo = "<?php echo $tipo?>"data-id="<?php echo $fila['id']?>" data-stock ="<?php echo $fila['stock']?>" data-cantidad="1" data-name="<?php echo $fila['nArticulo']?>">Comprar</button></div>
                        <?php } ?>
                        <!--En caso de que no seamos un invitado, podremos darle a like y comentar-->
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
                        <div class="descripcionInfo">
                            <?php echo $fila['detalles']?>
                        </div>
                        
                    </div>
                </div>
                    <div class="comentarios">
                    <?php if($rol != "invitado"){?>
                        <form id="comentarioForm">
                            <textarea class="textAreaArticulo" name="comentario" id="comentario" minlength="0" maxlength="1000" cols="90" rows="3"></textarea><?php if($rol!="invitado"){ ?><button class="botonComentario" name="comentario" id="comentario" data-idArticulo = "<?php echo $idArticulo;?>" data-rol="<?php echo $_SESSION["rol"]; ?>" data-idUsuario="<?php echo $_SESSION["id"]; ?>">Comentar</button></form><div id="verComentario"></div><?php } ?>
                            <button type="hidden" class="botonComentario esconder" name="comentario" id="comentario" data-idArticulo = "<?php echo $idArticulo;?>"></button><?php if($rol=="invitado"){ ?><div id="verComentario2"></div><?php } ?> <br>
                        <?php } ?>
                    </div>  
            </div>
        </div>
        <?php require_once('../footer/footer.php') ?>   
    </body>
</html>
<script src="js/comentario.js" type="text/javascript"></script>
<script src="js/likes.js" type="text/javascript"></script>
<script src="js/articulo.js"></script>