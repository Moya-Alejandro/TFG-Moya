<?php require_once('../header/header.php') ?>
<?php require_once('../nav/nav.php') ?>
<?php 
    $rol = "";
    if(isset($_SESSION["rol"])){
        $rol = $_SESSION["rol"];
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../index/css/index.css">
        <link rel="stylesheet" href="../migasPan/css/migasPan.css">
        <link rel="stylesheet" href="css/mapaSitio.css">
    </head>
    <body class="index">
        <div class="cuerpo">
            <div class="contenedorMapa">
                <ul id="migasPan">
                    <li><a href="../index/index.php"> Inicio </a></li>
                    <li><a href=""> Mapa del Sitio </a></li>
                </ul>
                <h1>Mapa del Sitio</h1>
                <div class="mapaSitio">   
                    <div class="contenedorColumna">
                        <div class="contImg"><img src="../img/categorias.png" alt="Imagen de lista"></div>
                        <div class="listaMapa">
                            <div class="listaMapaCont">
                                <ul>
                                    <li><a href="../categorias/categorias.php">Categorías</a></li>
                                    <ul>
                                        <li class="liHijo"><a href="../articulo/articulo.php?tipo=pistola">Artículo - Pistola</a></li>
                                        <li class="liHijo"><a href="../articulo/articulo.php?tipo=carabina">Artículo - Carabina</a></li>
                                        <li class="liHijo"><a href="../articulo/articulo.php?tipo=municion">Artículo - Municion</a></li>
                                        <li class="liHijo"><a href="../articulo/articulo.php?tipo=accesorios">Artículo - Accesorios</a></li>
                                    </ul>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="contenedorColumna">
                        <div class="contImg"><img src="../img/usuario-mapa.png" alt="Imagen de usuario"></div>
                        <div class="listaMapa">
                            <div class="listaMapaCont">
                                <ul>
                                    <li>Usuario</li>
                                    <ul>
                                        <?php if($rol == ""){ ?>
                                        <li class="liHijo"><a href="../login/login.php">Iniciar Sesión</a></li>
                                        <li class="liHijo"><a href="../registrar/registrar.php">Registrarse</a></li>
                                        <?php } else{ ?>
                                        <li class="liHijo"><a href="../perfil/perfil.php">Perfil</a></li>
                                        <li class="liHijo"><a href="../carrito/verCarrito.php">Carrito</a></li>
                                        <li class="liHijo"><a href="../../backend/usuario/cerrarSesion.php">Desconectarse</a></li>
                                        <?php } ?>
                                    </ul>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="contenedorColumna">
                        <div class="contImg"><img src="../img/competicion.png" alt="Imagen de una mira"></div>
                        <div class="listaMapa">
                            <div class="listaMapaCont">
                                <ul>
                                    <li>Competición</li>
                                    <ul>
                                        <li class="liHijo"><a href="../calendario/calendario.php">Calendario</a></li>
                                    </ul>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once('../footer/footer.php') ?>   
    </body>
</html>