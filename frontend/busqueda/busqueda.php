<?php 
    require_once('../header/header.php');
    require_once('../nav/nav.php');
    require '../../backend/bd/DAOarticulo.php';
    
    $conexion = conectarBd(true);
    $busqueda = $_GET["buscar"];

    $rol = "";
    if(isset($_SESSION["rol"])){
        $rol = $_SESSION["rol"];
    }


?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../index/index.css">
        <link rel="stylesheet" href="../migasPan/migasPan.css">
    </head>
    <body class="index">
        <ul id="migasPan">
            <li><a href="../index/index.php"> Inicio </a></li>
            <li><a href=""> Busqueda </a></li>
        </ul>
        <div>
            <div>
                <?php
                    $articulos = busquedaArticulo($conexion,$busqueda);
                while($fila = mysqli_fetch_assoc($articulos)){ ?>
                <div id="contenedorArticulo">
                    <a href="mostrarArticulo.php?id=<?php echo $fila['id']?>"><img src="../<?php echo $fila['foto']?>" alt="imagenArticulo"></a>
                    <?php echo $fila['nArticulo']?>
                    <?php echo $fila['precio']?>
                    <?php echo $fila['stock']?>
                    <?php if($rol == ""){ ?>
                    <?php } else{?>
                        <button class="enviar" id="insertarCarrito" name="insertarCarrito" data-id="<?php echo $fila['id']?>" data-precio="<?php echo $fila['precio']?>" data-stock ="<?php echo $fila['stock']?>" data-cantidad="1" data-name="<?php echo $fila['nArticulo']?>">Comprar</button>
                    <?php } ?>
                </div> 
                <?php } ?>
            </div>   
        </div>
        <?php require_once('../footer/footer.php') ?>  
    </body>
</html>