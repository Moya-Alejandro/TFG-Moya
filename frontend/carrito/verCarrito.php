<?php require_once('../header/header.php') ?>
<?php require_once('../nav/nav.php') ?>
<?php 
    require '../../backend/bd/DAOcarrito.php';

    if(!isset($_SESSION["rol"])){
        header("Location: ../index/index.php");
    }
    //Las id de los carritos coinciden con la id del usuario por lo que con el session["id"] sacamos la id del carrito también
    $idUsuario = $_SESSION["id"];
    $conexion = conectarBD(true);
    $total = "0";
    
    $articulosCarrito = mostrarCarrito($conexion, $idUsuario);

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../index/index.css">
        <link rel="stylesheet" href="carrito.css">
        <link rel="stylesheet" href="../migasPan/migasPan.css">
    </head>
    <body class="index">
        <ul id="migasPan">
            <li><a href="../index/index.php"> Inicio </a></li>
            <li><a href=""> Carrito </a></li>
        </ul>
        <div class="contenedor">
            <div class ="carrito">
                <h1>Realizar Compra</h1>
                    <table class="table" id="lista-compra">
                        <thead>
                            <tr>
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Sub Total</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($fila = mysqli_fetch_assoc($articulosCarrito)) { ?>
                            <tr>
                                <th><img src="../<?php echo $fila['foto']?>" alt="imagenArticulo"></th>
                                <th><?php echo $fila['nArticulo']?></th>
                                <th><?php echo $fila['precio']?></th>
                                <th><?php echo $fila['cantidad']?></th>
                                <th><?php echo $fila['precio']*$fila['cantidad']; $total += $fila['precio']*$fila['cantidad'];?></th>
                                <th><a href="../../backend/carrito/borrarArticuloCarrito.php?idArticulo=<?php echo $fila['idArticulo']?>"><i class="fas fa-times-circle"></i></a></th>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tr>
                            <th>TOTAL :</th>
                            <th>
                                <p id="total"><?php echo $total; ?></p>
                            </th>
                        </tr>
                    </table>
                    <div class="vaciar-carrito">
                        <p id="vaciar-carrito"><a href="../../backend/carrito/vaciarCarrito.php?idUsuario=<?php echo $idUsuario?>">Vaciar Carrito</a></p>
                    </div>
                    <div class="comprar">
                        <div id="paypal-button-container" data-total = <?php echo $total; ?>></div>
                    </div>
            </div>
        </div>
        <?php require_once('../footer/footer.php') ?>   
    </body>
</html>
<script src="https://www.paypal.com/sdk/js?client-id=test&currency=EUR"></script>
<script src="paypal.js"></script>
