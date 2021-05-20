<?php 
    require '../../backend/bd/conectarBD.php';
    require '../../backend/bd/DAOusuario.php';
    require '../../backend/bd/DAOcarrito.php';
    session_start();
    $conexion = conectarBD(true);

    $idCesta = $_SESSION["id"];
    $idArticulo = $_POST["idArticulo"];
    $precio = $_POST["precio"];
    $cantidad = $_POST["cantidad"];
    $tipo = $_POST["tipo"];

    $articuloId = mysqli_fetch_assoc(stockArticulo($conexion, $idArticulo));
    $stockArticulo = $articuloId["stock"];
    

    $filaCarrito = mysqli_num_rows(stockCarrito($conexion, $idCesta, $idArticulo));
    if($filaCarrito==0){
        $cantidadCesta = 0;
    }
    else{
        $carritoActual = mysqli_fetch_assoc(stockCarrito($conexion, $idCesta, $idArticulo));
        $cantidadCesta = $carritoActual["cantidad"];
    }

    if($cantidadCesta < $stockArticulo){ 
        $insertar = insertarArticulo($conexion,$precio,$cantidad,$idCesta,$idArticulo);
    }


?>