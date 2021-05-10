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

    function mostrarArticuloId($conexion,$id){
        $consulta = "SELECT * FROM articulo WHERE(id='$id')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
		return $resultadoConsulta;
    }
    
    function mostrarValoresId($conexion,$id){
        $consulta = "SELECT * FROM categoria WHERE(idArticulo='$id')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
		return $resultadoConsulta;
    }

    function borrarArticulo($conexion,$id){
        mysqli_begin_transaction($conexion);

        try {
            //Necesitamos la url de la imagen para borrarla
            $articulo = mostrarArticuloId($conexion,$id);
            $fila = mysqli_fetch_assoc($articulo);
            $ruta = $fila["foto"];
            unlink("../../frontend/".$ruta);

            $consulta = "DELETE FROM categoria WHERE (`idArticulo` = '$id')";
		    $resultadoConsulta = mysqli_query($conexion,$consulta);
            if(!$resultadoConsulta){
                //throw new Exception("Nombre duplicado");
                throw new Exception(mysqli_error($conexion)); //x
            }

            $consulta = "DELETE FROM articulo WHERE (`id` = '$id')";
		    $resultadoConsulta = mysqli_query($conexion,$consulta);
            if(!$resultadoConsulta){
                //throw new Exception("Nombre duplicado");
                throw new Exception(mysqli_error($conexion)); //x
            }

            mysqli_commit($conexion);

        } catch (Exception $e) {
            mysqli_rollback($conexion);
            throw $e;
        }
    }

?>