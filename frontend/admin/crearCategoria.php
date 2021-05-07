<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="login.css">
        <link rel="stylesheet" href="../index/index.css">
    </head>
    <body class="index">
        <?php require_once('../header/header.php') ?>
    <div class="contenedor">
        <form id="form" action="../../backend/admin/crearCategoria.php" method="POST">
            <div class="campos">
                <div class="campo">
                    <label for="nombre">Nombre de la Categoría </label>
                    <input id="nombre" type="text" name="nombre">
                    <p id="errorNombre">Algo ha salido mal</p>
                </div>
                <div class="contenedorInputs">
                    <input type="button" value="Crear" onclick="crearInputs()">
                    <div id="inputs">
                    </div>
                </div>
            </div>
            <button>Crear</button>
        </form>
    </div>
    </body>
</html>
<script src="crearCategoria.js"></script>
