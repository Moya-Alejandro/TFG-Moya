<?php 
    require_once('../header/header.php');
    require_once('../nav/nav.php');
    require '../../backend/bd/DAOarticulo.php';
    
    $tipo = $_GET["tipo"];
    $conexion = conectarBd(true);

    $rol = "";
    if(isset($_SESSION["rol"])){
        $rol = $_SESSION["rol"];
    }

    $error = "";
    if(isset($_GET["error"])){
        $error = $_GET["error"];
    }

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
        <link rel="stylesheet" href="../index/index.css">
        <link rel="stylesheet" href="../migasPan/migasPan.css">
    </head>
    <body class="index">
        <ul id="migasPan">
            <li><a href="../index/index.php"> Inicio </a></li>
            <li><a href="../categorias/categorias.php"> Categorías </a></li>
            <li><a href=""> Artículos </a></li>
        </ul>
        <div>
            <div>
                <form action="articulo.php?tipo=<?php echo $tipo?>" method="post">
                    <?php 
                        $result = filtroOpciones($conexion,$tipo);
                        while($filtroOpciones = mysqli_fetch_assoc($result)){
                    ?>
                    <div id="contenedorFiltro">
                        <b><?php echo $filtroOpciones['nombre'];?></b>
                        <?php 
                        $resultValor = filtroValores($conexion,$filtroOpciones['id'],$tipo);
                        while($filtroValores = mysqli_fetch_assoc($resultValor)){
                        ?>
                        <div id="filtro">
                            <input name="filtroSeleccionado[]" value="<?php echo $filtroValores['id']; ?>" type="checkbox"><label><?php echo $filtroValores['nombre'];?></label> 
                        </div> 
                        <?php } ?>
                    </div>
                    <?php }?>
                    <button type="submit">Filtrar</button>
                </form>
            </div>      
            <div>
                <?php while($fila = mysqli_fetch_assoc($articulos)){ ?>
                <div id="contenedorArticulo">
                    <a href="mostrarArticulo.php?id=<?php echo $fila['id']?>"><img src="../<?php echo $fila['foto']?>" alt="imagenArticulo"></a>
                    <?php echo $fila['nArticulo']?>
                    <?php echo $fila['precio']?>
                    <?php echo $fila['stock']?>
                    <?php if($rol == ""){ ?>
                    <?php } else{?>
                        <button class="enviar" id="insertarCarrito" name="insertarCarrito" data-tipo = "<?php echo $tipo?>"data-id="<?php echo $fila['id']?>" data-stock ="<?php echo $fila['stock']?>" data-cantidad="1" data-name="<?php echo $fila['nArticulo']?>">Comprar <span><?php echo $error; ?></span></button>
                    <?php } ?>
                </div> 
                <?php } ?>
            </div>   
        </div>
        <?php require_once('../footer/footer.php') ?>  
    </body>
</html>