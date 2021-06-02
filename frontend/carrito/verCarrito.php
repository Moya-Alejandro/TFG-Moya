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
        <link rel="stylesheet" href="../index/css/index.css">
        <link rel="stylesheet" href="css/carrito.css">
        <link rel="stylesheet" href="../migasPan/css/migasPan.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    </head>
    <body class="index">
        <div class="cuerpo">
            <div class="contenedorCarrito">
                <ul id="migasPan">
                    <li><a href="../index/index.php"> Inicio </a></li>
                    <li><a href=""> Carrito </a></li>
                </ul>
                <div class ="carrito">
                    <table class="table" id="lista-compra">
                        <thead>
                            <tr>
                                <th class="tablaImg">Imagen</th>
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
                                <th class="tablaImg"><img src="../<?php echo $fila['foto']?>" alt="imagenArticulo"></th>
                                <th><?php echo $fila['nArticulo']?></th>
                                <th><?php echo $fila['precio']?></th>
                                <th><form action="../../backend/carrito/actualizarCantidadCesta.php" method="POST"><input name="cantidad" type="number" min="1" max ="<?php echo $fila['stock'];?>"value="<?php echo $fila['cantidad']?>"><input name="idArticulo" type="hidden" value="<?php echo $fila["idArticulo"] ?>"><button>Actualizar</button></form></th>
                                <th><?php echo $fila['precio']*$fila['cantidad']; $total += $fila['precio']*$fila['cantidad'];?></th>
                                <th><a href="../../backend/carrito/borrarArticuloCarrito.php?idArticulo=<?php echo $fila['idArticulo']?>"><i class="fas fa-times-circle"></i></a></th>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tr>
                            <td colspan="2">
                                <div class="comprar">
                                    <div id="paypal-button-container" data-total = <?php echo $total; ?>></div>
                                </div>
                            </td>
                            <td>
                                <p>TOTAL:</p>
                            </td>
                            <td>
                                <div>
                                    <p id="total"><?php echo $total; ?></p>
                                </div>
                            </td>
                            <td>
                                <div class="vaciar-carrito">
                                <p id="vaciar-carrito"><a href="../../backend/carrito/vaciarCarrito.php?idUsuario=<?php echo $idUsuario?>">Vaciar<i class="material-icons">remove_shopping_cart</i></a></p>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <?php require_once('../footer/footer.php') ?>   
    </body>
</html>
<script src="https://www.paypal.com/sdk/js?client-id=test&currency=EUR"></script>
<script src="js/paypal.js"></script>
