<?php

    //Llamamos a los archivos que contienen funciones de la base de datos para poder utilizar sus funciones
    require '../../backend/bd/conectarBD.php';
    require '../../backend/bd/DAOusuario.php';

    //Guardamos en una variable la función que nos conecta a la base de datos, en este caso verdadera, ya que es en AWS(RDS)
    $conexion = conectarBd(true);

    //Recogemos las variables que se le pasa desde el frontend y la guardamos en una variable
    $idArticulo = $_POST['idArticulo'];
    $idUsuario = $_POST['idUsuario'];
    $comentario = $_POST['comentario'];
   
    //Llamamos a la consulta de la base de datos por una función
    $insertarComentario = insertarComentario($conexion,$idUsuario,$idArticulo,$comentario);


?>