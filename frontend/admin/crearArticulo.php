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
        <div class="cuerpo">
            <div class="contenedorCrearArticulo">
                <ul id="migasPan">
                    <li><a href="../index/index.php"> Inicio </a></li>
                    <li><a href="../panel/panelArticulo.php"> Panel Artículo </a></li>
                    <li><a href=""> Crear Artículo </a></li>
                </ul>
                <div class="carta-body">
                    <div class="carta">
                        <form action="../../backend/admin/crearArticulo.php" method="post" enctype="multipart/form-data">
                            <h2>Crear Artículo</h2>
                            <div class="imgCampos">
                                <div class="contenedorImg">
                                    <div class="placeHolder"  onClick="activador()"></div>
                                    <img src="../img/avatar.png" onClick="activador()" id="mostrarProducto">
                                    <input class ="subirImagen" type="file" name="imagen" onChange="mostrarImagen(this)" id="imagen">
                                </div>
                                <div class="campos">
                                    <div class="campo">
                                        <label for="nArticulo">Nombre del Artículo</label>
                                        <input class="inputForm" id="nArticulo" placeholder="Pistola Azul" type="text" name="nArticulo" >
                                    </div>
                                    <div class="campo">
                                        <label for="precio">Precio</label>
                                        <input class="inputForm" id="precio" min="1" placeholder="15,50" step=".01" type="number" name="precio" >
                                    </div>
                                    <div class="campo">
                                        <label for="stock">Stock</label>
                                        <input class="inputForm" id="stock" min="1" placeholder="10" type="number" name="stock" >
                                    </div>
                                    <div class="campo" >
                                        <label for="detalles">Descripción</label>
                                        <textarea placeholder="Pistola de color azul..." name="detalles" maxlength="300"></textarea><br><br>
                                    </div>
                                <div class="campo campoTipo">
                                    <div class="tipo">
                                        <label for="tipo">Tipo </label><br>
                                    </div>
                                    <div >
                                        Pistola <input type="radio" id="pistola" name="tipo" value="pistola" required><br>
                                        Carabina <input type="radio" id="carabina" name="tipo" value="carabina" required><br>
                                        Munición <input type="radio" id="municion" name="tipo" value="municion" required><br>
                                        Accesorios <input type="radio" id="accesorios" name="tipo" value="accesorios" required><br>
                                    </div>
                                </div>
                                <div class="campo" >
                                    <div class="categoria">
                                        <label for="categoria">Categoria </label><br>
                                    </div>
                                    <div class="categoriaSelect">
                                        <?php 
                                            $conexion = conectarBd(true);
                                            $categorias = mostrarCategorias($conexion);
                                            foreach($categorias as $key => $value ){ 
                                        ?>
                                        <label class="labelCategoria" value="<?php echo $value["id"]?>"><?php echo $value["nombre"]?></label> 
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
                            </div>
                            </div>
                            <div>
                                <p><strong><?php echo $error?></strong></p>
                                <button type="submit">Crear</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once('../footer/footer.php') ?>   
    </body>
</html>
<script src="crearArticulo.js"></script>