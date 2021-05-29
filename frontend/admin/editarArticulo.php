<?php require_once('../header/header.php') ?>
<?php require_once('../nav/nav.php') ?>
<?php
    require '../../backend/bd/DAOarticulo.php';
    require '../../backend/bd/DAOcategoria.php';

    $idArticulo = $_GET["idArticulo"];
    $conexion = conectarBd(true);
    $funcionArticulo = mostrarArticuloId($conexion,$idArticulo);
    $articulo = mysqli_fetch_assoc($funcionArticulo);
    
    $error = "";
    if(isset($_GET["error"])){
        $error = $_GET["error"];
    }

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="crearArticulo.css">
        <link rel="stylesheet" href="../index/index.css">
        <link rel="stylesheet" href="../migasPan/migasPan.css">
    </head>
    <body class="index">
        <div class="contenedor">
            <ul id="migasPan">
                <li><a href="../index/index.php"> Inicio </a></li>
                <li><a href="../panel/panelArticulo.php"> Panel Artículo </a></li>
                <li><a href=""> Editar Artículo </a></li>
            </ul>
            <div class="carta-body">
                <form action="../../backend/admin/editarArticulo.php" method="post" enctype="multipart/form-data">
                    <h2>Editar Artículo</h2>
                    <div>
                        <div class="placeHolder"  onClick="activador()"></div>
                        <img src="../<?php echo $articulo["foto"]?>" onClick="activador()" id="mostrarProducto">
                        <input class ="subirImagen" type="file" name="imagen" onChange="mostrarImagen(this)" id="imagen">
                    </div>
                    <div class="campos">
                        <div class="campo">
                            <label for="nArticulo">Nombre</label>
                            <input id="nArticulo" value="<?php echo $articulo["nArticulo"] ?>" type="text" name="nArticulo" >
                            <input type ="hidden" name="idArticulo" value="<?php echo $articulo['id']?>">
                        </div>
                        <div class="campo">
                            <label for="precio">Precio </label>
                            <input id="precio" value="<?php echo $articulo["precio"] ?>" type="text" name="precio" >
                        </div>
                        <div class="campo">
                            <label for="stock">Stock </label>
                            <input id="stock" value="<?php echo $articulo["stock"] ?>" type="text" name="stock" >
                        </div>
                        <div class="campo" >
                            <label for="detalles">Detalles </label>
                            <textarea name="detalles"><?php echo $articulo['detalles'];?></textarea><br><br>
                        </div>
                        <div class="campo">
                            <label for="tipo">Tipo </label>
                            <?php $tipoSeleccionado = mysqli_fetch_assoc(tipoSeleccionado($conexion,$idArticulo)); ?>    
                            Pistola<input required type="radio" id="pistola" name="tipo" value="pistola" <?php if ($tipoSeleccionado["tipo"] == "pistola"){?> checked="checked" <?php } ?>><br>
                            Carabina<input required type="radio" id="carabina" name="tipo" value="carabina" <?php if ($tipoSeleccionado["tipo"] == "carabina"){?> checked="checked" <?php } ?>><br>
                            Munición<input required type="radio" id="municion" name="tipo" value="municion" <?php if ($tipoSeleccionado["tipo"] == "municion"){?> checked="checked" <?php } ?>><br>
                            Accesorios<input required type="radio" id="accesorios" name="tipo" value="accesorios" <?php if ($tipoSeleccionado["tipo"] == "accesorios"){?> checked="checked" <?php } ?>><br>  
                        </div>
                        <div class="campo" >
                            <label for="categoria">Categoría </label>
                                <?php 
                                    $conexion = conectarBd(true);
                                    $categorias = mostrarCategorias($conexion);
                                    foreach($categorias as $key => $value ){ 
                                ?>
                                <label value="<?php echo $value["id"]?>"><?php echo $value["nombre"]?></label> 
                                <?php $valores = cogerValores($conexion,$value["id"]);
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
                    <div>
                        <p><strong><?php echo $error?></strong></p>
                        <button type="submit">Editar</button>
                    </div>
                </form>
            </div>
        </div>
        <?php require_once('../footer/footer.php') ?>   
    </body>
</html>
<script src="crearArticulo.js"></script>