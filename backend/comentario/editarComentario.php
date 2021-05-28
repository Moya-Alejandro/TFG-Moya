<?php 
    require '../bd/conectarBD.php';
	require '../bd/DAOusuario.php';
    
    if(!isset($_SERVER['HTTP_REFERER'])){
        header("Location: ../../frontend/index/index.php");
        exit;
    }

    $conexion = conectarBD(true);
    $idComentario = $_POST["idComentario"];
    $comentario = $_POST["comentario"];


    editarComentario($conexion,$idComentario,$comentario);



?>