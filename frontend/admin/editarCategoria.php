<?php require_once('../header/header.php') ?>
<?php require_once('../nav/nav.php') ?>
<?php
    //Llamamos a los archivos que contienen funciones de la base de datos para poder utilizar sus funciones
    require '../../backend/bd/DAOcategoria.php';

    //Guardamos en una variable la idArticulo que recibimos desde Panel articulo
    $idCategoria = $_GET["idCategoria"];

    //Realizamos la conexión a la base de datos y guardamos en variables la consulta de la base de datos
    $conexion = conectarBd(true);
    $funcionOpcion = cogerOpcion($conexion,$idCategoria);
    $opcion = mysqli_fetch_assoc($funcionOpcion);
    $valores = cogerValores($conexion,$idCategoria);
    
    //Iniciamos la variable error vacia y en caso de que exista cambiaremos su valor
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
        <link rel="stylesheet" href="../index/css/index.css">
        <link rel="stylesheet" href="css/crearCategoria.css">
        <link rel="stylesheet" href="../migasPan/css/migasPan.css">
    </head>
    <body class="index">
        <div class="cuerpo">
            <div class="contenedorCrearCategoria">
                <ul id="migasPan">
                    <li><a href="../index/index.php"> Inicio </a></li>
                    <li><a href="../panel/panelCategoria.php"> Panel Categoría </a></li>
                    <li><a href=""> Editar Categoría </a></li>
                </ul>
                <div class="contenedorForm">
                    <h4>Editar Categoría</h4>
                    <div class="carta-body">
                        <form id="form" action="../../backend/admin/editarCategoria.php" method="POST">
                            <div class="campos">
                                <!--Mostramos los valores de la categoría seleccionado para editar-->
                                <div class="campo">
                                    <label for="nombre">Nombre de la Categoría </label>
                                    <input class="nombreCategoria" id="nombre" value="<?php echo $opcion['nombre'];?>" type="text" name="nombre">
                                    <input type ="hidden" name="idOpcion" value="<?php echo $opcion['id']?>">
                                </div>
                                <div class="contenedorInputs">
                                    <p class="valores">Valores<label for="crearValor"> <i class="fas fa-plus-square"></i></label></p>
                                    <input type="button" id="crearValor"  class="botonCrearValor" value="Crear" onclick="crearInputs()">
                                    <div id="inputs">
                                        <?php  
                                            //Creamos los inputs de los valores ya existentes
                                            foreach($valores as $key => $value){?>
                                        <div class="divValores"> 
                                            <input value="<?php echo $value['nombre']?>" name="valor[]" type="text">
                                            <input type ="hidden" value="<?php echo $value['id']?>" name="idValor[]">
                                                <?php if($key == 0){ ?>
                                                    <form>
                                                    </form>
                                                <?php } else{ ?> 
                                                <form id="formBorrarValor" action="../../backend/admin/borrarValor.php?idValor=<?php echo $value['id']?>&idCategoria=<?php echo $idCategoria?>" method="POST">
                                                    <label class="labelBasura" for="borrarValor"><i class="fas fa-trash"></i></label>
                                                    <button id="borrarValor" class="borrarValorBoton">Borrar</button>
                                                </form>
                                                <?php } ?>
                                        </div>
                                            <?php } ?>
                                    </div>
                                </div>
                                <button>Crear</button>
                            </div>
                            <p style="color:red;"><strong><?php echo $error?></strong></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once('../footer/footer.php') ?>   
    </body>
</html>
<script src="js/crearCategoria.js"></script>
