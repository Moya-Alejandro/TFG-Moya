<?php 

    require '../../backend/bd/conectarBD.php';
    require '../../backend/bd/DAOusuario.php';
    require '../../backend/bd/DAOcarrito.php';
    session_start();
    $conexion = conectarBD(true);

    $idUsuario = $_SESSION['id'];

    $numeroArticulos = numeroArticulos($conexion, $idUsuario);
    $totalArticulos = mysqli_fetch_assoc($numeroArticulos);
    
    echo($totalArticulos['Count(idUsuario)']);

?>