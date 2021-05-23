<?php 

    function insertarArticulo($conexion,$cantidad,$idUsuario,$idArticulo){
        $consulta = "INSERT INTO carrito (`idArticulo`,`idUsuario`,`cantidad`) VALUES ('$idArticulo','$idUsuario', '$cantidad') ON DUPLICATE KEY UPDATE cantidad = cantidad+1";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
		return $resultadoConsulta;
    }


    function numeroArticulos($conexion, $idUsuario){
        $consulta = "SELECT Count(idUsuario) FROM carrito where idUsuario='$idUsuario'";
        $resultado= mysqli_query($conexion,$consulta);
        return $resultado;
    }

    function mostrarCarrito($conexion, $idUsuario){
        $consulta = "SELECT * FROM carrito inner join articulo on carrito.idArticulo = articulo.id WHERE (idUsuario = '$idUsuario')";
        $resultado= mysqli_query($conexion,$consulta);
        return $resultado;
    }

    
    function stockCarrito($conexion, $idUsuario, $idArticulo){
        $consulta = "SELECT * FROM carrito inner join articulo on carrito.idArticulo = articulo.id WHERE (idUsuario = '$idUsuario') AND (idArticulo = '$idArticulo')";
        $resultado= mysqli_query($conexion,$consulta);
        return $resultado;
    }
    
    function stockArticulo($conexion, $idArticulo){
        $consulta = "SELECT * FROM articulo WHERE(id='$idArticulo')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
		return $resultadoConsulta;
    }
    

    function borrarArticuloCarrito($conexion,$idUsuario,$idArticulo){
        $consulta = "DELETE FROM carrito WHERE (`idUsuario` = '$idUsuario') AND (idArticulo = '$idArticulo')";
        $resultado= mysqli_query($conexion,$consulta);
        return $resultado;
    }

    function vaciarCarrito($conexion,$idUsuario){
        $consulta = "DELETE FROM carrito WHERE (`idUsuario` = '$idUsuario')";
        $resultado= mysqli_query($conexion,$consulta);
        return $resultado;
    }

    function borrarStock($conexion,$stock,$idArticulo){

    }

    

?>