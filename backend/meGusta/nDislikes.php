<?php 
    require '../bd/conectarBD.php';
	require '../bd/DAOarticulo.php';

    $idArticulo = $_GET["idArticulo"];
    $conexion = conectarBD(true);

    $valoracion = mysqli_fetch_assoc(sumarVerDislikes($conexion,$idArticulo)) ;
    
    echo $valoracion["count(gusta)"];
?>