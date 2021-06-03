<?php require_once('../header/header.php') ?>
<?php require_once('../nav/nav.php') ?>
<?php
    //Llamamos a los archivos que contienen funciones de la base de datos para poder utilizar sus funciones
    require '../../backend/bd/DAOarticulo.php';
    require '../../backend/bd/DAOcategoria.php';

    //Guardamos en una variable la idArticulo que recibimos desde Panel articulo
    $idArticulo = $_GET["idArticulo"];

    //Realizamos la conexión a la base de datos y guardamos en variables la consulta de la base de datos
    $conexion = conectarBd(true);
    $funcionArticulo = mostrarArticuloId($conexion,$idArticulo);
    $articulo = mysqli_fetch_assoc($funcionArticulo);
    
    //Iniciamos la variable error vacia y en caso de que exista cambiaremos su valor
    $error = "";
    if(isset($_GET["error"])){
        $error = $_GET["error"];
    }

    //En caso de que el enlace sea escrito por la barra de búsqueda nos devolverá al index
    if(!isset($_SERVER['HTTP_REFERER'])){
        header("Location: ../../frontend/index/index.php");
        exit;
    }
    
    //En caso de que el rol del usuario no sea admin, te redirijirá a inicio
    if($_SESSION["rol"] != "admin"){
        header('Location: ../index/index.php');
    }

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/crearArticulo.css">
        <link rel="stylesheet" href="../index/css/index.css">
        <link rel="stylesheet" href="../migasPan/css/migasPan.css">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>
    <body class="index">
        <div class="cuerpo">
            <div class="contenedorCrearArticulo">
                <ul id="migasPan">
                    <li><a href="../index/index.php"> Inicio </a></li>
                    <li><a href="../panel/panelArticulo.php"> Panel Artículo </a></li>
                    <li><a href=""> Editar Artículo </a></li>
                </ul>
                <div class="carta-body">
                    <div class="carta">
                        <form action="../../backend/admin/editarArticulo.php" method="post" enctype="multipart/form-data">
                            <h2>Editar Artículo</h2>
                            <div class="imgCampos">
                                <div class="contenedorImg">
                                <!--Mostramos los valores del articulo seleccionado para editar-->
                                    <div class="placeHolder"  onClick="activador()"></div>
                                    <img src="../<?php echo $articulo["foto"]?>" onClick="activador()" id="mostrarProducto">
                                    <input class ="subirImagen" type="file" name="imagen" onChange="mostrarImagen(this)" id="imagen">
                                </div>
                                <div class="campos">
                                    <div class="campo">
                                        <label for="nArticulo">Nombre del Artículo</label>
                                        <input class="inputForm" id="nArticulo" value="<?php echo $articulo["nArticulo"] ?>" type="text" name="nArticulo" required >
                                        <input type ="hidden" name="idArticulo" value="<?php echo $articulo['id']?>">
                                    </div>
                                    <div class="campo">
                                        <label for="precio">Precio </label>
                                        <input class="inputForm" id="precio" min="1" value="<?php echo $articulo["precio"] ?>"  step=".01" type="number" name="precio" required>
                                    </div>
                                    <div class="campo">
                                        <label for="stock">Stock </label>
                                        <input class="inputForm" id="stock" min="1" value="<?php echo $articulo["stock"] ?>" type="number" name="stock" required >
                                    </div>
                                    <div class="campo" >
                                        <label for="detalles">Descripción </label>
                                        <textarea name="detalles" maxlength="300" required><?php echo $articulo['detalles'];?></textarea><br><br>
                                    </div>
                                    <div class="campo campoTipo">
                                        <div class="tipo">
                                            <label for="tipo">Tipo </label>
                                        </div>
                                        <div>
                                            <!--Marcamos el input con el tipo del articulo seleccionado para editar-->
                                            <?php $tipoSeleccionado = mysqli_fetch_assoc(tipoSeleccionado($conexion,$idArticulo)); ?>    
                                            Pistola<input required type="radio" id="pistola" name="tipo" value="pistola" <?php if ($tipoSeleccionado["tipo"] == "pistola"){?> checked="checked" <?php } ?>><br>
                                            Carabina<input required type="radio" id="carabina" name="tipo" value="carabina" <?php if ($tipoSeleccionado["tipo"] == "carabina"){?> checked="checked" <?php } ?>><br>
                                            Munición<input required type="radio" id="municion" name="tipo" value="municion" <?php if ($tipoSeleccionado["tipo"] == "municion"){?> checked="checked" <?php } ?>><br>
                                            Accesorios<input required type="radio" id="accesorios" name="tipo" value="accesorios" <?php if ($tipoSeleccionado["tipo"] == "accesorios"){?> checked="checked" <?php } ?>><br>  
                                        </div>
                                    </div>
                                    <div class="campo" >
                                        <div class="categoria">
                                            <label for="categoria">Categoría </label>
                                        </div>
                                        <div class="categoriaSelect">
                                            <?php 
                                                //Guardamos en una variable la consulta de las categorías para mostrarlas y editarlas
                                                $conexion = conectarBd(true);
                                                $categorias = mostrarCategorias($conexion);
                                                foreach($categorias as $key => $value ){ 
                                            ?>
                                            <label class="labelCategoria" value="<?php echo $value["id"]?>"><?php echo $value["nombre"]?></label> 
                                            <?php $valores = cogerValores($conexion,$value["id"]);
                                                //Guardamos en una variable los valores que ya existen para mostrarlos y poder editarlos
                                                $valorSeleccionado = mysqli_fetch_assoc(valoresSeleccionados($conexion,$value["id"],$idArticulo));
                                            ?>          
                                                <select id="selectValor" name="selectValor[]">
                                                    <option value = "vacio"></option>
                                                    <?php foreach($valores as $key => $value ){
                                                        if($valorSeleccionado["idValor"] == $value["id"]){
                                                    ?>
                                                    <option value="<?php echo $value["id"]?>" selected><?php echo $value["nombre"]?></option>
                                                    <?php } else{?>
                                                    <option value="<?php echo $value["id"]?>"><?php echo $value["nombre"]?></option>
                                                    <?php }}?>
                                                </select>
                                            <?php 
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="botonCrearDiv">
                                <?php 
                                    if(isset($_GET['error']) && $_GET['error'] == "$error"){ 
                                        echo "<script>swal('Melilla Shooting', '$error', 'error');</script>";
                                    }
                                ?>
                                <button class="botonCrear" type="submit"><div class="crearArticulo">Editar</div></button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once('../footer/footer.php') ?>   
    </body>
</html>
<script src="js/crearArticulo.js"></script>