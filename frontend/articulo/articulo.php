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
 
        while($_POST['filtroSeleccionado']){
            $valores = "".implode("', '",$_POST['filtroSeleccionado'])."";
            $string = "SELECT DISTINCT articulo.id,articulo.nArticulo,articulo.precio,articulo.precio,articulo.stock,articulo.foto,articulo.detalles,articulo.tipo FROM articulo inner join categoria on categoria.idArticulo = articulo.id inner join valor on valor.id = categoria.idValor WHERE valor.nombre IN ('$valores') AND (articulo.tipo = '$tipo')";
            $articuloPorFiltro = mysqli_fetch_assoc(articuloPorFiltro($conexion,$valores,$tipo));
            print_r($articuloPorFiltro);
        }
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
                        <input name="filtroSeleccionado[]" value="<?php echo $filtroValores['nombre']; ?>" type="checkbox"><label><?php echo $filtroValores['nombre'];?></label> 
                    </div> 
                    <?php } ?>
                </div>
                <?php }?>
                <input type ="submit">
            </form>
        </div> 

        <div>

        </div>   
    </div>
</body>
</html>