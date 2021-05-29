<?php 
    require '../bd/conectarBD.php';
	require '../bd/DAOarticulo.php';

    $idArticulo = $_GET["idArticulo"];
    $conexion = conectarBD(true);

    $valoracion = mysqli_fetch_assoc(sumaVerLikes($conexion,$idArticulo));
    
    echo $valoracion['sum(gusta)'];
?>