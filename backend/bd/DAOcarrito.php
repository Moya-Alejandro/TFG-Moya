<?php 

    function insertarArticulo($conexion,$precio,$cantidad,$idCesta,$idArticulo){
        $consulta = "INSERT INTO productoCarrito (`precio`, `cantidad`, `idCesta`, `idArticulo`) VALUES ('$precio', '$cantidad', '$idCesta', '$idArticulo')";
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






?>