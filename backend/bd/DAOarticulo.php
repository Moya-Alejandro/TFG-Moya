<?php 
    //?
    function crearSesion($f){
        session_id($f['id']);
        session_start();
        $_SESSION['id'] = $f['id'];
        $_SESSION['nArticulo'] = $f['nArticulo'];
        $_SESSION['precio'] = $f['precio'];
        $_SESSION['stock'] = $f['stock'];
        $_SESSION['foto'] = $f['foto'];
        $_SESSION['detalles'] = $f['detalles'];
        $_SESSION['tipo'] = $f['tipo'];
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

    function valoresSeleccionados($conexion,$idOpcion){
        $consulta = "SELECT categoria.idValor FROM categoria inner join valor on valor.id = categoria.idValor inner join opcion on opcion.id = valor.idOpcion WHERE(opcion.id = $idOpcion)";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
		return $resultadoConsulta;
    }

    function tipoSeleccionado($conexion,$idArticulo){
        $consulta = "SELECT tipo FROM articulo WHERE(id = $idArticulo)";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
		return $resultadoConsulta;
    }

    function editarArticulo($conexion,$idArticulo,$selectValor,$nArticulo,$precio,$foto,$stock,$detalles,$tipo){
        mysqli_begin_transaction($conexion);

        try {
            //Necesitamos borrar la foto antigüa
            $consulta = "DELETE FROM categoria WHERE (`idArticulo` = '$idArticulo')";
		    $resultadoConsulta = mysqli_query($conexion,$consulta);
            if(!$resultadoConsulta){
                //throw new Exception("Nombre duplicado");
                throw new Exception(mysqli_error($conexion)); //x
            }

            $consulta = "UPDATE articulo SET `nArticulo` = '$nArticulo', `precio` = '$precio', `stock` = '$stock', `foto` = '$foto', `detalles` = '$detalles', `tipo` = '$tipo' WHERE (`id` = '$idArticulo')";
		    $resultadoConsulta = mysqli_query($conexion,$consulta);
            if(!$resultadoConsulta){
                //throw new Exception("Nombre duplicado");
                throw new Exception(mysqli_error($conexion)); //x
            }
  
            foreach($selectValor as $key => $value){
                if($value!="vacio"){
                    $stmt = mysqli_prepare($conexion, 'INSERT INTO categoria (`idValor`, `idArticulo`) VALUES (?, ?)');
                    mysqli_stmt_bind_param($stmt,'ii', $value, $idArticulo);
                    $ejecutar = mysqli_stmt_execute($stmt);
                    if(!$ejecutar){
                        throw new Exception(mysqli_error($conexion)); //x
                    }
                }
            }
            mysqli_commit($conexion);

        } catch (Exception $e) {
            mysqli_rollback($conexion);
            throw $e;
        }
    }


?>