<?php require_once('../header/header.php') ?>
<?php require_once('../nav/nav.php') ?>
<?php 
    //Llamamos a los archivos que contienen funciones de la base de datos para poder utilizar sus funciones
    require '../../backend/bd/DAOcarrito.php';

    //En caso de que no exista un rol, nos redirijirá al inicio
    if(!isset($_SESSION["rol"])){
        header("Location: ../index/index.php");
    }
    //Las id de los carritos coinciden con la id del usuario por lo que con el session["id"] sacamos la id del carrito también
    $idUsuario = $_SESSION["id"];
    
    //Inicializamos la variable total en 0
    $total = "0";

    //Realizamos la conexión a la base de datos y guardamos en variables la consulta de la base de datos
    $conexion = conectarBD(true);
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
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
                            <!--Mostramos en una tabla los datos del articulo en la cesta-->
                            <?php while ($fila = mysqli_fetch_assoc($articulosCarrito)) { ?>
                            <tr>
                                <th class="tablaImg"><div class="contenedorImgCarrito"><img class="imgCarrito" src="../<?php echo $fila['foto']?>" alt="imagenArticulo"></div></th>
                                <th><?php echo $fila['nArticulo']?></th>
                                <th><?php echo $fila['precio']?>€</th>
                                <th><form action="../../backend/carrito/actualizarCantidadCesta.php" method="POST"><input name="cantidad" type="number" min="1" max ="<?php echo $fila['stock'];?>"value="<?php echo $fila['cantidad']?>"><input name="idArticulo" type="hidden" value="<?php echo $fila["idArticulo"] ?>"><button class="botonActualizarCantidad">Actualizar</button></form></th>
                                <th><?php echo $fila['precio']*$fila['cantidad']; $total += $fila['precio']*$fila['cantidad'];?>€</th>
                                <th><i onclick="confirmarBorrar(<?php echo $fila['idArticulo']?>)" class="fas fa-times-circle" id="iconoBorrar"></i></th>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tr>
                            <!--Botón paypal-->
                            <td colspan="2">
                                <div class="comprar">
                                    <div id="paypal-button-container" class="botonPaypalFondo" data-total = <?php echo $total; ?>></div>
                                </div>
                            </td>
                            <!--Mostraremos el total de la suma de los precio-->
                            <td>
                                <p>TOTAL:</p>
                            </td>
                            <td>
                                <div>
                                    <p id="total"><?php echo $total; ?>€</p>
                                </div>
                            </td>
                            <td colspan="2">
                            <!--Botón para poder vaciar el carrito-->
                                <div class="vaciar-carrito">
                                    <div id="vaciar-carrito"><button class="botonVaciarCarrito" onclick="confirmarBorrarCarrito(<?php echo $idUsuario?>)">Vaciar Carrito</button></div>
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
<script src="js/verCarrito.js"></script>