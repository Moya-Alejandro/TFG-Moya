<?php 
    //Llamamos a los archivos que contienen funciones de la base de datos para poder utilizar sus funciones
    require '../bd/conectarBD.php';
	require '../bd/DAOcarrito.php';

    //Guardamos en una variable la función que nos conecta a la base de datos, en este caso verdadera, ya que es en AWS(RDS)
    $conexion = conectarBD(true);

    //Recogemos las variables que se le pasa desde el frontend y la guardamos en una variable
    $idUsuario = $_GET["idUsuario"];

    //Llamamos a la función para que realize la consulta y acto siguiente nos redirija
    $vaciarCarrito = vaciarCarrito($conexion,$idUsuario);
    header("Location: ../../frontend/carrito/verCarrito.php");

?>