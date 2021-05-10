<?php
    require_once('../header/header.php');
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
    </head>
    <body class="index">
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
                        <p id="errorArticulo">Algo ha salido mal</p>
                    </div>
                    <div class="campo">
                        <label for="precio">Precio </label>
                        <input id="precio" value="<?php echo $articulo["precio"] ?>" type="text" name="precio" >
                        <p id="errorPrecio">Algo ha salido mal</p>
                    </div>
                    <div class="campo">
                        <label for="stock">Stock </label>
                        <input id="stock" value="<?php echo $articulo["stock"] ?>" type="text" name="stock" >
                        <p id="errorStock">Algo ha salido mal</p>
                    </div>
                    <div class="campo" >
                        <label for="detalles">Detalles: </label>
                        <textarea name="detalles"><?php echo $articulo['detalles'];?></textarea><br><br>
                    </div>
                    <div class="campo" >
                        <label for="categoria">Categoria </label>
                            <?php 
                                $conexion = conectarBd(true);
                                //$valoresArticulo = mostrarValoresId($conexion,$idArticulo);
                                //print_r($valoresArticulo); 
                                $categorias = mostrarCategorias($conexion);
                                foreach($categorias as $key => $value ){ 
                            ?>
                            <label value="<?php echo $value["id"]?>"><?php echo $value["nombre"]?></label> 
                            <?php $valores = cogerValores($conexion,$value["id"]);
                            ?>          
                                <select id="selectValor" name="selectValor[]">
                                    <option value = " "></option
                                    <?php foreach($valores as $key => $value ){?>
                                    <option value="<?php echo $value["id"]?>"><?php echo $value["nombre"]?></option>
                                    <?php }?>
                                </select>
                            <?php 
                                }
                            ?>
                    </div>
                </div>
                <div>
                    <p><strong><?php echo $error?></strong></p>
                    <button type="submit">Crear</button>
                </div>
            </form>
        </div>
    </body>
</html>
<script src="crearArticulo.js"></script>