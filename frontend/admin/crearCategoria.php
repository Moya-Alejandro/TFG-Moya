<?php require_once('../header/header.php') ?>
<?php require_once('../nav/nav.php') ?>
<?php
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
        <link rel="stylesheet" href="css/crearCategoria.css">
        <link rel="stylesheet" href="../index/css/index.css">
        <link rel="stylesheet" href="../migasPan/css/migasPan.css">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>
    <body class="index">
        <div class="cuerpo">
            <div class="contenedorCrearCategoria">
                <ul id="migasPan">
                    <li><a href="../index/index.php"> Inicio </a></li>
                    <li><a href="../panel/panelCategoria.php"> Panel Categoría </a></li>
                    <li><a href=""> Crear Categoría </a></li>
                </ul>
                <div class="contenedorForm">
                    <h4>Crear Categoría</h4>
                    <div class="carta-body">
                        <form id="form" action="../../backend/admin/crearCategoria.php" method="POST">
                            <div class="campos">
                                <div class="campo">
                                    <label for="nombre">Nombre de la Categoría</label><br>
                                    <input id="nombre" placeholder="Nombre de la Categoría" type="text" name="nombre" required>
                                </div>
                                <div class="contenedorInputs">
                                    <p class="valores">Valores<label for="crearValor"> <i class="fas fa-plus-square"></i></label></p>
                                    <!--La funcion crear input nos creará un campo input para generar nuevos valores-->
                                    <input id="crearValor" class="botonCrearValor" type="button" value="Crear" onclick="crearInputs()">
                                    <div id="inputs">
                                        <div class="divValores" id="1">
                                            <input name="valor[]" type="text" required>
                                        </div>
                                    </div>
                                </div>
                                <button class="botonCrear"><div class="botonCrearDiv">Crear</div></button>
                            </div>
                            <?php 
                                if(isset($_GET['error']) && $_GET['error'] == "$error"){ 
                                    echo "<script>swal('Melilla Shooting', '$error', 'error');</script>";
                                }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once('../footer/footer.php') ?>   
    </body>
</html>
<script src="js/crearCategoria.js"></script>
