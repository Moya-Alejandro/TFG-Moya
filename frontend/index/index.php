<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.css" crossorigin="anonymous">
        <link rel="stylesheet" href="css/index.css">
        <link rel="stylesheet" href="../migasPan/css/migasPan.css">
        <!--Llamamos aquí a los archivos para que no haya conflicto con los estilos de Boostrap-->
        <?php require_once('../header/header.php') ?>
        <?php require_once('../nav/nav.php') ?>

        <?php 
            //Llamamos a los archivos que contienen funciones de la base de datos para poder utilizar sus funciones
            require '../../backend/bd/DAOarticulo.php';
            
            $conexion = conectarBd(true);

            $consulta = imagenesCarrouselMasVotados($conexion);
            $masVotados = array();
            while($fila = mysqli_fetch_assoc($consulta)){
                array_push($masVotados,$fila);
            }

            $consulta = imagenesCarrouselMasNuevos($conexion);
            $masNuevos = array();
            while($fila = mysqli_fetch_assoc($consulta)){
                array_push($masNuevos,$fila);
            }
        ?>
    </head>
    <body class="index">
        <div class="cuerpoIndex">
            <div class="contenedorIndexInicio">
                <ul id="migasPan">
                    <li><a href="" class="activo"> Inicio </a></li>
                </ul>
                <div class="cuerpoCarrouseles">
                    <div class="cuerpoCarousel">
                        <div class="tituloMasVotados"><h2>Destacados</h2></div>
                        <div id="carouselExampleIndicators" class="carousel slide bordeCarrousel arreglarTamaño" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <a href="../articulo/mostrarArticulo.php?id=<?php echo $masVotados[0]["idArticulo"]?>&tipo=<?php echo $masVotados[0]["tipo"]?>">
                                        <img src="../<?php echo $masVotados[0]["foto"]?>" width="100%" class="d-block w-100 imagenes" alt="...">
                                    </a>
                                </div>
                                <div class="carousel-item">
                                    <a href="../articulo/mostrarArticulo.php?id=<?php echo $masVotados[1]["idArticulo"]?>&tipo=<?php echo $masVotados[1]["tipo"]?>">
                                        <img src="../<?php echo $masVotados[1]["foto"]?>" width="100%" class="d-block w-100 imagenes" alt="...">
                                    </a>
                                </div>
                                <div class="carousel-item">
                                    <a href="../articulo/mostrarArticulo.php?id=<?php echo $masVotados[2]["idArticulo"]?>&tipo=<?php echo $masVotados[2]["tipo"]?>">
                                        <img src="../<?php echo $masVotados[2]["foto"]?>" width="100%" class="d-block w-100 imagenes" alt="...">
                                    </a>
                                </div>
                                <div class="carousel-item">
                                    <a href="../articulo/mostrarArticulo.php?id=<?php echo $masVotados[3]["idArticulo"]?>&tipo=<?php echo $masVotados[3]["tipo"]?>">
                                        <img src="../<?php echo $masVotados[3]["foto"]?>" width="100%" class="d-block w-100 imagenes" alt="...">
                                    </a>
                                </div>
                                <div class="carousel-item">
                                    <a href="../articulo/mostrarArticulo.php?id=<?php echo $masVotados[4]["idArticulo"]?>&tipo=<?php echo $masVotados[4]["tipo"]?>">
                                        <img src="../<?php echo $masVotados[4]["foto"]?>" width="100%" class="d-block w-100 imagenes" alt="...">
                                    </a>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="cuerpoCarousel">
                        <div class="tituloMasNuevos"><h2>Últimas Novedades</h2></div>
                        <div id="carouselExampleIndicators2" class="carousel slide bordeCarrousel arreglarTamaño" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators2" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators2" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators2" data-slide-to="2"></li>
                                <li data-target="#carouselExampleIndicators2" data-slide-to="3"></li>
                                <li data-target="#carouselExampleIndicators2" data-slide-to="4"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <a href="../articulo/mostrarArticulo.php?id=<?php echo $masNuevos[0]["id"]?>&tipo=<?php echo $masNuevos[0]["tipo"]?>">
                                        <img src="../<?php echo $masNuevos[0]["foto"]?>" width="100%" class="d-block w-100 imagenes" alt="...">
                                    </a>
                                </div>
                                <div class="carousel-item">
                                    <a href="../articulo/mostrarArticulo.php?id=<?php echo $masNuevos[1]["id"]?>&tipo=<?php echo $masNuevos[1]["tipo"]?>">
                                        <img src="../<?php echo $masNuevos[1]["foto"]?>" width="100%" class="d-block w-100 imagenes" alt="...">
                                    </a>
                                </div>
                                <div class="carousel-item">
                                    <a href="../articulo/mostrarArticulo.php?id=<?php echo $masNuevos[2]["id"]?>&tipo=<?php echo $masNuevos[2]["tipo"]?>">
                                        <img src="../<?php echo $masNuevos[2]["foto"]?>" width="100%" class="d-block w-100 imagenes" alt="...">
                                    </a>
                                </div>
                                <div class="carousel-item">
                                    <a href="../articulo/mostrarArticulo.php?id=<?php echo $masNuevos[3]["id"]?>&tipo=<?php echo $masNuevos[3]["tipo"]?>">
                                        <img src="../<?php echo $masNuevos[3]["foto"]?>" width="100%" class="d-block w-100 imagenes" alt="...">
                                    </a>
                                </div>
                                <div class="carousel-item">
                                    <a href="../articulo/mostrarArticulo.php?id=<?php echo $masNuevos[4]["id"]?>&tipo=<?php echo $masNuevos[4]["tipo"]?>">
                                        <img src="../<?php echo $masNuevos[4]["foto"]?>" width="100%" class="d-block w-100 imagenes" alt="...">
                                    </a>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators2" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <?php require_once('../footer/footer.php') ?>   
    </body>
</html>
