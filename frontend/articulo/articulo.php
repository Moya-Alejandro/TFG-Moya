<?php 
    require_once('../header/header.php');
    require_once('../nav/nav.php');

    //Llamamos a los archivos que contienen funciones de la base de datos para poder utilizar sus funciones
    require '../../backend/bd/DAOarticulo.php';
    
    //Guardamos en una variable la idArticulo que recibimos desde Panel articulo
    $tipo = $_GET["tipo"];

    //Realizamos la conexión a la base de datos
    $conexion = conectarBd(true);

    //Iniciamos la variable rol vacia y en caso de que exista cambiaremos su valor
    $rol = "";
    if(isset($_SESSION["rol"])){
        $rol = $_SESSION["rol"];
    }

    //Inicializamos la variable articulos y en caso de que no haya ningún filtro seleccionado nos mostrará todos los articulos, si hay un filtro seleccionado, nos mostrará solo esos articulos
    $articulos;

    if (empty ($_POST['filtroSeleccionado'])) {

        $articulos = filtroArticulos($conexion,$tipo);

    } 
    elseif (!empty($_POST['filtroSeleccionado'])) {
            
        $articulos = articuloPorFiltro($conexion, $_POST['filtroSeleccionado'], $tipo);
        
    }

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../index/css/index.css">
        <link rel="stylesheet" href="css/articulo.css">
        <link rel="stylesheet" href="../migasPan/css/migasPan.css">
    </head>
    <body class="index">
        <div class="cuerpo">
            <div class="contenedorArticulo">
                <ul id="migasPan">
                    <li><a href="../index/index.php"> Inicio </a></li>
                    <li><a href="../categorias/categorias.php"> Categorías </a></li>
                    <li><a href=""> Artículos </a></li>
                </ul>
                <div class="dividirPagina">
                    <div class="filtrosIzquierda">
                        <form action="articulo.php?tipo=<?php echo $tipo?>" method="post">
                            <div class="titulo">
                                <h2 class="filtroPor">Filtrar Por</h2>
                            </div>
                            <?php 
                                //Mostraremos los campos que hay en los filtros
                                $result = filtroOpciones($conexion,$tipo);
                                while($filtroOpciones = mysqli_fetch_assoc($result)){
                            ?>
                            <div id="contenedorFiltro">
                                <div class="infoFiltro">
                                    <b>Filtrar por <?php echo $filtroOpciones['nombre'];?>:</b>
                                    <?php 
                                    $resultValor = filtroValores($conexion,$filtroOpciones['id'],$tipo);
                                    while($filtroValores = mysqli_fetch_assoc($resultValor)){
                                    ?>
                                    <div id="filtro">
                                        <div class="campoFiltro"><?php echo $filtroValores['nombre'];?></div><div class="inputCampoFiltro"><input name="filtroSeleccionado[]" value="<?php echo $filtroValores['id']; ?>" type="checkbox"></div>
                                    </div> 
                                    <?php } ?>
                                </div>
                            </div>
                            <?php }?>
                            <div class="botonParaFiltro">
                                <button class="botonFiltrar" type="submit">Filtrar</button>
                            </div>
                        </form>
                    </div>      
                    <div class="articulosDerecha">
                        <?php //Mostraremos los articulos
                        while($fila = mysqli_fetch_assoc($articulos)){ ?>
                        <div id="contenedorArticuloProducto">
                            <div class="contenedorImagen">
                                <a class="imgCarta" href="mostrarArticulo.php?id=<?php echo $fila['id']?>&tipo=<?php echo $tipo; ?>"><img class="imgCarta" src="../<?php echo $fila['foto']?>" alt="imagenArticulo"></a>
                            </div>
                            <div class="contenedorNombre">
                                <p class="valueNombre"><?php echo $fila['nArticulo']?></p>
                            </div>
                            <?php if($rol == ""){ ?>
                            <?php } else{?>
                                <div class="botonComprar"><button <?php if($fila['stock'] == 0){ echo "onclick='stockVacio()'"; } ?> class="enviar" id="insertarCarrito" name="insertarCarrito" data-tipo = "<?php echo $tipo?>"data-id="<?php echo $fila['id']?>" data-stock ="<?php echo $fila['stock']?>" data-cantidad="1" data-name="<?php echo $fila['nArticulo']?>">Comprar</button></div>
                            <?php } ?>
                        </div> 
                        <?php } ?>
                    </div>   
                </div>
            </div>
        </div>
        <?php require_once('../footer/footer.php') ?>  
    </body>
</html>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="js/articulo.js"></script>