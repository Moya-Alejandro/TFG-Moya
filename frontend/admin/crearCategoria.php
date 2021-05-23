<?php require_once('../header/header.php') ?>
<?php require_once('../nav/nav.php') ?>
<?php
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
        <link rel="stylesheet" href="crearCategoria.css">
        <link rel="stylesheet" href="../index/index.css">
    </head>
    <body class="index">
    <div class="contenedor">
        <form id="form" action="../../backend/admin/crearCategoria.php" method="POST">
            <div class="campos">
                <div class="campo">
                    <input id="nombre" placeholder="Nombre de la Categoría" type="text" name="nombre">
                    <p id="errorNombre">Algo ha salido mal</p>
                </div>
                <div class="contenedorInputs">
                    <input type="button" value="Crear" onclick="crearInputs()">
                    <div id="inputs">
                        <div id="1">
                            <input name="valor[]" type="text">
                        </div>
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
