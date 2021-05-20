<?php

    require '../../backend/bd/conectarBD.php';
    require '../../backend/bd/DAOusuario.php';
    $conexion = conectarBd(true);

    $idArticulo = $_POST['idArticulo'];
    $idUsuario = $_POST['idUsuario'];
    $comentario = $_POST['comentario'];
   
    $insertarComentario = insertarComentario($conexion,$idUsuario,$idArticulo,$comentario);


?>