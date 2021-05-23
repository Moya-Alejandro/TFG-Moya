<?php 
    require '../../backend/bd/conectarBD.php';
    require '../../backend/bd/DAOusuario.php';
    require '../../backend/bd/DAOcarrito.php';
    session_start();
    $conexion = conectarBD(true);

    $idUsuario = $_SESSION["id"];
    $idArticulo = $_POST["idArticulo"];
    $cantidad = $_POST["cantidad"];

    $articuloId = mysqli_fetch_assoc(stockArticulo($conexion, $idArticulo));
    $stockArticulo = $articuloId["stock"];
    

    $filaCarrito = mysqli_num_rows(stockCarrito($conexion, $idUsuario, $idArticulo));
    if($filaCarrito==0){
        $cantidadCesta = 0;
    }
    else{
        $carritoActual = mysqli_fetch_assoc(stockCarrito($conexion, $idUsuario, $idArticulo));
        $cantidadCesta = $carritoActual["cantidad"];
    }

    if($cantidadCesta < $stockArticulo){ 
        $insertar = insertarArticulo($conexion,$cantidad,$idUsuario,$idArticulo);
    }


?>