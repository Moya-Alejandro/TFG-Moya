<?php 

    function insertarArticulo($conexion,$precio,$cantidad,$idCesta,$idArticulo){
        $consulta = "INSERT INTO productoCarrito (`precio`, `cantidad`, `idCesta`, `idArticulo`) VALUES ('$precio', '$cantidad', '$idCesta', '$idArticulo') ON DUPLICATE KEY UPDATE cantidad = cantidad+1; ";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
		return $resultadoConsulta;
    }

    function crearCarrito($conexion,$idCesta,$idUsuario){
        $consulta = "INSERT INTO cesta (`idcesta`, `idusuario`, `precioTotal`) VALUES ('$idCesta', '$idUsuario', '0.00')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
		return $resultadoConsulta;
    }

    function numeroArticulos($conexion, $idCesta){
        $consulta = "SELECT Count(idCesta) FROM productoCarrito where idCesta='$idCesta'";
        $resultado= mysqli_query($conexion,$consulta);
        return $resultado;
    }

    function mostrarCarrito($conexion, $idCesta){
        $consulta = "SELECT * FROM productoCarrito inner join articulo on productoCarrito.idArticulo = articulo.id WHERE (idCesta = '$idCesta')";
        $resultado= mysqli_query($conexion,$consulta);
        return $resultado;
    }

    
    function stockCarrito($conexion, $idCesta, $idArticulo){
        $consulta = "SELECT * FROM productoCarrito inner join articulo on productoCarrito.idArticulo = articulo.id WHERE (idCesta = '$idCesta') AND (idArticulo = '$idArticulo')";
        $resultado= mysqli_query($conexion,$consulta);
        return $resultado;
    }
    
    function stockArticulo($conexion, $idArticulo){
        $consulta = "SELECT * FROM articulo WHERE(id='$idArticulo')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
		return $resultadoConsulta;
    }
    

    function borrarArticuloCarrito($conexion,$idCesta,$idArticulo){
        $consulta = "DELETE FROM productoCarrito WHERE (`idCesta` = '$idCesta') AND (idArticulo = '$idArticulo')";
        $resultado= mysqli_query($conexion,$consulta);
        return $resultado;
    }

    function vaciarCarrito($conexion,$idCesta){
        $consulta = "DELETE FROM productoCarrito WHERE (`idCesta` = '$idCesta')";
        $resultado= mysqli_query($conexion,$consulta);
        return $resultado;
    }

    function precioTotal($conexion,$idCesta){
        $consulta = "SELECT sum(precio*cantidad) as total from productoCarrito WHERE (idCesta = '$idCesta')";
        $resultado= mysqli_query($conexion,$consulta);
        return $resultado;
    }

    function editarPrecioTotal($conexion,$idCesta){
        $consulta = "SELECT sum(precio*cantidad) from productoCarrito WHERE (idCesta = '$idCesta')";
        $resultado= mysqli_query($conexion,$consulta);
        return $resultado;
    }

    

?>