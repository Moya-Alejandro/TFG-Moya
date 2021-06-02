<?php 
    require_once('../header/header.php');
    require_once('../nav/nav.php');

    //Llamamos a los archivos que contienen funciones de la base de datos para poder utilizar sus funciones
    require '../../backend/bd/DAOarticulo.php';
    
    //Realizamos la conexión a la base de datos
    $conexion = conectarBd(true);

    //Guardamos en una variable la idArticulo que recibimos desde Panel articulo
    $busqueda = $_GET["buscar"];

    //Iniciamos la variable rol vacia y en caso de que exista cambiaremos su valor
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
        <link rel="stylesheet" href="../index/css/index.css">
        <link rel="stylesheet" href="css/busqueda.css">
        <link rel="stylesheet" href="../migasPan/css/migasPan.css">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>
    <body class="index">
        <div class="cuerpo">
            <div class="contenedorBusqueda">
                <ul id="migasPan">
                    <li><a href="../index/index.php"> Inicio </a></li>
                    <li><a href=""> Busqueda </a></li>
                </ul>
                <div>
                    <div>
                        <?php
                            //En caso de que no exista ningún articulo buscado, nos saldrá una alerta y nos mandará al inicio
                            $articulos = busquedaArticulo($conexion,$busqueda);
                            $filas = mysqli_num_rows ( $articulos);
                            if($filas == 0){
                                echo "<script>
                                        swal('No se ha encontrado ningún articulo con ese nombre',{
                                            button: 'Volver a Inicio',
                                            timer: 4000
                                        })
                                        .then((value) => {
                                            window.location= '../index/index.php';
                                        });
                                    </script>";
                            } ?>
                            <!--En el caso de que si exista, nos mostrará los articulos-->
                            <?php while($fila = mysqli_fetch_assoc($articulos)){ ?>
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
            </div>
        </div>
        <?php require_once('../footer/footer.php') ?>  
    </body>
</html>