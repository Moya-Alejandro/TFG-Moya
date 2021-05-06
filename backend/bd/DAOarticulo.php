<?php 
    function crearSesion($f){
        session_id($f['id']);
        session_start();
        $_SESSION['id'] = $f['id'];
        $_SESSION['nArticulo'] = $f['nArticulo'];
        $_SESSION['precio'] = $f['precio'];
        $_SESSION['stock'] = $f['stock'];
        $_SESSION['foto'] = $f['foto'];
        $_SESSION['detalles'] = $f['detalles'];
    }

    function mostrarArticulos($conexion){
		$consulta = "SELECT * FROM articulo";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
		return $resultadoConsulta;
	}

    //Faltan los valores de otras tablas (categoria valor opcion)
    function insertarArticulo($conexion,$nArticulo,$precio,$stock,$foto,$detalles){
        $consulta = "INSERT INTO articulo (`nArticulo`, `precio`, `stock`, `foto`, `detalles`) VALUES ('$nArticulo', '$precio', '$stock', '$foto', '$detalles')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
		return $resultadoConsulta;
    }

?>