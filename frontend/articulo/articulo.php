<?php 
    require_once('../header/header.php');
    require_once('../nav/nav.php');
    require '../../backend/bd/DAOarticulo.php';
    
    $tipo = $_GET["tipo"];
    $conexion = conectarBd(true);

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
    </head>
    <body class="index">
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
                    <img src="../<?php echo $fila['foto']?>" alt="imagenArticulo">
                    <?php echo $fila['nArticulo']?>
                    <?php echo $fila['precio']?>
                    <?php echo $fila['stock']?>
                </div> 
                <?php } ?>
            </div>   
        </div>
        <?php require_once('../footer/footer.php') ?>   
    </body>
</html>