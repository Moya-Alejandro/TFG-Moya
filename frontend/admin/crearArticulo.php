<?php
    require_once('../header/header.php');
    require_once('../nav/nav.php');
    require '../../backend/bd/DAOcategoria.php';
    
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
        <ul id="migasPan">
            <li><a href="../index/index.php"> Inicio </a></li>
            <li><a href="../panel/panelArticulo.php"> Panel Articulo </a></li>
            <li><a href=""> Crear Articulo </a></li>
        </ul>
        <div class="carta-body">
            <form action="../../backend/admin/crearArticulo.php" method="post" enctype="multipart/form-data">
                <h2>Crear Artículo</h2>
                <div>
                    <div class="placeHolder"  onClick="activador()"></div>
                    <img src="../img/avatar.png" onClick="activador()" id="mostrarProducto">
                    <input class ="subirImagen" type="file" name="imagen" onChange="mostrarImagen(this)" id="imagen">
                </div>
                <div class="campos">
                    <div class="campo">
                        <input id="nArticulo" placeholder="Nombre" type="text" name="nArticulo" >
                        <p id="errorArticulo">Algo ha salido mal</p>
                    </div>
                    <div class="campo">
                        <input id="precio" placeholder="Precio" type="text" name="precio" >
                        <p id="errorPrecio">Algo ha salido mal</p>
                    </div>
                    <div class="campo">
                        <input id="stock" placeholder="Stock" type="text" name="stock" >
                        <p id="errorStock">Algo ha salido mal</p>
                    </div>
                    <div class="campo" >
                        <textarea placeholder="Detalles..." name="detalles"></textarea><br><br>
                    </div>
                    <div class="campo">
                        <label for="tipo">Tipo </label>
                        Pistola<input type="radio" id="pistola" name="tipo" value="pistola"><br>
                        Carabina<input type="radio" id="carabina" name="tipo" value="carabina"><br>
                        Municion<input type="radio" id="municion" name="tipo" value="municion"><br>
                        Accesorios<input type="radio" id="accesorios" name="tipo" value="accesorios"><br>
                    </div>
                    <div class="campo" >
                        <label for="categoria">Categoria </label>
                            <?php 
                                $conexion = conectarBd(true);
                                $categorias = mostrarCategorias($conexion);
                                foreach($categorias as $key => $value ){ 
                            ?>
                            <label value="<?php echo $value["id"]?>"><?php echo $value["nombre"]?></label> 
                            <?php $valores = cogerValores($conexion,$value["id"]); ?>          
                                <select id="selectValor" name="selectValor[]">
                                    <option value="vacio"></option>
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
        <?php require_once('../footer/footer.php') ?>   
    </body>
</html>
<script src="crearArticulo.js"></script>