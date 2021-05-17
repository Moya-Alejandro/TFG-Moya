<?php
    require_once('../header/header.php');
    require '../../backend/bd/DAOcategoria.php';

    $idCategoria = $_GET["idCategoria"];
    $conexion = conectarBd(true);
    $funcionOpcion = cogerOpcion($conexion,$idCategoria);
    $opcion = mysqli_fetch_assoc($funcionOpcion);
    $valores = cogerValores($conexion,$idCategoria);
    
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
        <link rel="stylesheet" href="../index/index.css">
        <link rel="stylesheet" href="crearCategoria.css">
    </head>
    <body class="index">
    <div class="contenedor">
        <form id="form" action="../../backend/admin/editarCategoria.php" method="POST">
            <div class="campos">
                <div class="campo">
                    <label for="nombre">Nombre de la Categoría </label>
                    <input id="nombre" value="<?php echo $opcion['nombre'];?>" type="text" name="nombre">
                    <input type ="hidden" name="idOpcion" value="<?php echo $opcion['id']?>">
                    <p id="errorNombre">Algo ha salido mal</p>
                </div>
                <div class="contenedorInputs">
                    <input type="button" value="Crear" onclick="crearInputs()">
                    <div id="inputs">
                        <?php  
                            foreach($valores as $key => $value){?>
                        <div> 
                            <input value="<?php echo $value['nombre']?>" name="valor[]" type="text">
                            <input type ="hidden" value="<?php echo $value['id']?>" name="idValor[]">
                                <?php if($key == 0){ ?>
                                    <form>
                                    </form>
                                <?php } else{ ?> 
                                <form id="formBorrarValor" action="../../backend/admin/borrarValor.php?idValor=<?php echo $value['id']?>&idCategoria=<?php echo $idCategoria?>" method="POST">
                                    <button>Borrar</button>
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
    <?php require_once('../footer/footer.php') ?>   
    </body>
</html>
<script src="crearCategoria.js"></script>
