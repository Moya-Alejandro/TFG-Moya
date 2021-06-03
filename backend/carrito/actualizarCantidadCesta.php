<?php 

    //En caso de que el enlace sea escrito por la barra de búsqueda nos devolverá al index
    if(!isset($_SERVER['HTTP_REFERER'])){
        header("Location: ../../frontend/index/index.php");
        exit;
    }
    
    //Llamamos a los archivos que contienen funciones de la base de datos para poder utilizar sus funciones
    require '../bd/conectarBD.php';
	require '../bd/DAOcarrito.php';
    
    //Guardamos en una variable la función que nos conecta a la base de datos, en este caso verdadera, ya que es en AWS(RDS)
    $conexion = conectarBD(true);
    
    //Recogemos las variables que se le pasa desde el frontend y la guardamos en una variable
    $cantidad = $_POST["cantidad"];
    $idArticulo = $_POST["idArticulo"];

    //Llamamos a la función para que realize la consulta y acto siguiente nos redirija
    actualizarCantidad($conexion,$idArticulo,$cantidad);
    header("Location: ../../frontend/carrito/verCarrito.php")
?>