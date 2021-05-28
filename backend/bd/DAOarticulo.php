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

    function valoresSeleccionados($conexion,$idOpcion,$idArticulo){
        $consulta = "SELECT categoria.idValor FROM categoria inner join valor on valor.id = categoria.idValor inner join opcion on opcion.id = valor.idOpcion WHERE(opcion.id = $idOpcion and categoria.idArticulo = $idArticulo)";
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

    function filtroOpciones($conexion,$tipo){
        $consulta = "SELECT DISTINCT opcion.id, opcion.nombre FROM opcion inner join valor on valor.idOpcion = opcion.id inner join categoria on categoria.idValor = valor.id inner join articulo on articulo.id = categoria.idArticulo WHERE(articulo.tipo = '$tipo')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);        
		return $resultadoConsulta;
    }

    function filtroValores($conexion,$idOpcion,$tipo){
        $consulta = "SELECT DISTINCT valor.id,valor.nombre FROM valor inner join opcion on opcion.id = valor.idOpcion inner join categoria on categoria.idValor = valor.id inner join articulo on articulo.id = categoria.idArticulo WHERE(idOpcion = '$idOpcion' AND tipo = '$tipo')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);        
		return $resultadoConsulta;
    }

    function filtroArticulos($conexion,$tipo){
        $consulta = "SELECT * FROM articulo WHERE(tipo = '$tipo')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);        
		return $resultadoConsulta;
    }

    function filtro($conexion,$idValor,$tipo){
        $consulta = "SELECT * FROM articulo inner join categoria on categoria.idArticulo = articulo.id inner join valor on categoria.idValor = valor.id WHERE(valor.id = '$idValor' AND articulo.tipo = '$tipo')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);        
		return $resultadoConsulta;
    }

    function articuloPorFiltro($conexion,$valores,$tipo){
        $consulta = "SELECT DISTINCT articulo.id,articulo.nArticulo,articulo.precio,articulo.precio,articulo.stock,articulo.foto,articulo.detalles,articulo.tipo FROM articulo inner join categoria on categoria.idArticulo = articulo.id inner join valor on valor.id = categoria.idValor Where valor.id IN (".implode(',',$valores).") AND tipo = '$tipo'";
		$resultadoConsulta = mysqli_query($conexion,$consulta);  
		return $resultadoConsulta;
    }

    function busquedaArticulo($conexion,$busqueda){
        $consulta = "SELECT * FROM articulo WHERE nArticulo LIKE '%$busqueda%'";
		$resultadoConsulta = mysqli_query($conexion,$consulta);  
		return $resultadoConsulta;
    }

    function meGustaArticulo($conexion,$idArticulo,$idUsuario,$valoracion){
        $consulta = "INSERT INTO megustas (idArticulo,idUsuario,gusta) VALUES($idArticulo,$idUsuario,$valoracion) ON DUPLICATE KEY UPDATE gusta = $valoracion";
		$resultadoConsulta = mysqli_query($conexion,$consulta);  
		return $resultadoConsulta;
    }

    function verMeGustaArticulo($conexion,$idArticulo,$idUsuario){
        $consulta = "SELECT gusta FROM megustas WHERE(idArticulo = '$idArticulo') AND (idUsuario = '$idUsuario')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);  
		return $resultadoConsulta;
    }

    function verLikeDeArticulo($conexion,$idArticulo,$idUsuario){
        $consulta = "SELECT * FROM megustas WHERE(idArticulo = '$idArticulo') AND (idUsuario = '$idUsuario')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);  
		return $resultadoConsulta;
    }

    function editarLike($conexion,$valoracion,$idArticulo,$idUsuario){
        $consulta = "UPDATE megustas SET `gusta` = '$valoracion' WHERE (`idUsuario` = '$idUsuario') AND (`idArticulo` = '$idArticulo')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);  
		return $resultadoConsulta;
    }


    function verMeGustaTotal($conexion,$idArticulo){
        $consulta = "SELECT gusta FROM megustas WHERE(idArticulo = '$idArticulo')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);  
		return $resultadoConsulta;
    }

    
    function borrarComentario($conexion,$id){
        $consulta = "DELETE FROM comentario WHERE (id = '$id')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);  
		return $resultadoConsulta;
    }


?>
