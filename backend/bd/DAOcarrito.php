<?php 

    //Función para insertar a la tabla carrito un artículo
    function insertarArticulo($conexion,$cantidad,$idUsuario,$idArticulo){
        $consulta = "INSERT INTO carrito (`idArticulo`,`idUsuario`,`cantidad`) VALUES ('$idArticulo','$idUsuario', '$cantidad') ON DUPLICATE KEY UPDATE cantidad = cantidad+1";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
		return $resultadoConsulta;
    }

    //Función para contar el número de artículos que tiene un carrito
    function numeroArticulos($conexion, $idUsuario){
        $consulta = "SELECT Count(idUsuario) FROM carrito where idUsuario='$idUsuario'";
        $resultado= mysqli_query($conexion,$consulta);
        return $resultado;
    }

    //Función para mostrar todos los artículos que tiene el carrito
    function mostrarCarrito($conexion, $idUsuario){
        $consulta = "SELECT * FROM carrito inner join articulo on carrito.idArticulo = articulo.id WHERE (idUsuario = '$idUsuario')";
        $resultado= mysqli_query($conexion,$consulta);
        return $resultado;
    }

    //Función para ver el stock que tiene un artículo que está dentro del carrito, según la id del artículo
    function stockCarrito($conexion, $idUsuario, $idArticulo){
        $consulta = "SELECT * FROM carrito inner join articulo on carrito.idArticulo = articulo.id WHERE (idUsuario = '$idUsuario') AND (idArticulo = '$idArticulo')";
        $resultado= mysqli_query($conexion,$consulta);
        return $resultado;
    }
    
    //Función para ver el stock que tiene un artículo según su id
    function stockArticulo($conexion, $idArticulo){
        $consulta = "SELECT * FROM articulo WHERE(id='$idArticulo')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
		return $resultadoConsulta;
    }
    
    //Función para eliminar un artículo de la tabla de carrito
    function borrarArticuloCarrito($conexion,$idUsuario,$idArticulo){
        $consulta = "DELETE FROM carrito WHERE (`idUsuario` = '$idUsuario') AND (idArticulo = '$idArticulo')";
        $resultado= mysqli_query($conexion,$consulta);
        return $resultado;
    }

    //Función para eliminar todos los artículos de un carrito
    function vaciarCarrito($conexion,$idUsuario){
        $consulta = "DELETE FROM carrito WHERE (`idUsuario` = '$idUsuario')";
        $resultado= mysqli_query($conexion,$consulta);
        return $resultado;
    }

    //Función para ver la cantidad y el idArticulo del carrito de un usuario en concreto
    function cogerStockCesta($conexion,$idUsuario){
        $consulta = "SELECT idArticulo,cantidad FROM carrito WHERE (idUsuario = '$idUsuario')";
        $resultado= mysqli_query($conexion,$consulta);
        return $resultado;
    }
    
    //Función para eliminar el stock de los artículos una vez finalizado el pago
    function borrarStock($conexion,$stock,$idArticulo){
        $consulta = "UPDATE articulo SET `stock` = stock-'$stock' WHERE (`id` = '$idArticulo')";
        $resultado= mysqli_query($conexion,$consulta);
        return $resultado;
    }

    //Función para actualizar la cantidad de un producto en contreto dentro del carrito
    function actualizarCantidad($conexion,$idArticulo,$cantidad){
        $consulta = "UPDATE carrito SET `cantidad` = '$cantidad' WHERE (`idArticulo` = '$idArticulo')";
        $resultado= mysqli_query($conexion,$consulta);
        return $resultado;
    }

    

?>