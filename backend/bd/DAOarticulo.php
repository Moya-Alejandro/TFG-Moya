<?php 
    
    //Función que crea una sesión para poder usar el session start con las variables del usuario
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

    //Función que recoge todos los campos de la tabla artículo
    function mostrarArticulos($conexion){
		$consulta = "SELECT * FROM articulo";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
		return $resultadoConsulta;
	}

    //Función que muestra todos los campos de la tabla artículo con una id específica
    function mostrarArticuloId($conexion,$id){
        $consulta = "SELECT * FROM articulo WHERE(id='$id')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
		return $resultadoConsulta;
    }
    
    //Función que muestra los valores del artículo cuya id hayamos pasado
    function mostrarValoresId($conexion,$id){
        $consulta = "SELECT * FROM categoria WHERE(idArticulo='$id')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
		return $resultadoConsulta;
    }

    //Función que borra un artículo según la id que hayamos pasado
    function borrarArticulo($conexion,$id){
        //Esta función no se ejecutará hasta que todo esté correcto
        mysqli_begin_transaction($conexion);

        //Preparamos todas las consultas que necesitamos para borrar el artículo
        try {
            //Necesitamos la url de la imagen para borrarla
            $articulo = mostrarArticuloId($conexion,$id);
            $fila = mysqli_fetch_assoc($articulo);
            $ruta = $fila["foto"];
            unlink("../../frontend/".$ruta);

            $consulta = "DELETE FROM categoria WHERE (`idArticulo` = '$id')";
		    $resultadoConsulta = mysqli_query($conexion,$consulta);
            if(!$resultadoConsulta){
                throw new Exception(mysqli_error($conexion)); 
            }

            $consulta = "DELETE FROM articulo WHERE (`id` = '$id')";
		    $resultadoConsulta = mysqli_query($conexion,$consulta);
            if(!$resultadoConsulta){
                throw new Exception(mysqli_error($conexion)); 
            }
            //Una vez todo esté correcto se ejecutarán todas las consultas
            mysqli_commit($conexion);

        } 
        //Recogerá el error y no se realizará ninguna consulta
        catch (Exception $e) {
            mysqli_rollback($conexion);
            throw $e;
        }
    }

    //Función que selecciona los valores del artículo según la id del articulo y la id de la opción, hacemos inner join para ir entrando en las tablas y nos salga los campos que necesitamos
    function valoresSeleccionados($conexion,$idOpcion,$idArticulo){
        $consulta = "SELECT categoria.idValor FROM categoria inner join valor on valor.id = categoria.idValor inner join opcion on opcion.id = valor.idOpcion WHERE(opcion.id = $idOpcion and categoria.idArticulo = $idArticulo)";
		$resultadoConsulta = mysqli_query($conexion,$consulta);        
		return $resultadoConsulta;
    }

    //Función para seleccionar el valor del campo tipo del artículo según la id introducida
    function tipoSeleccionado($conexion,$idArticulo){
        $consulta = "SELECT tipo FROM articulo WHERE(id = $idArticulo)";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
		return $resultadoConsulta;
    }

    //Función para editar el artículo
    function editarArticulo($conexion,$idArticulo,$selectValor,$nArticulo,$precio,$foto,$stock,$detalles,$tipo){
         //Esta función no se ejecutará hasta que todo esté correcto
        mysqli_begin_transaction($conexion);

        //Preparamos todas las consultas que necesitamos para editar el artículo
        try {
            //Necesitamos borrar la foto antigüa
            $consulta = "DELETE FROM categoria WHERE (`idArticulo` = '$idArticulo')";
		    $resultadoConsulta = mysqli_query($conexion,$consulta);
            if(!$resultadoConsulta){
                throw new Exception(mysqli_error($conexion)); 
            }

            $consulta = "UPDATE articulo SET `nArticulo` = '$nArticulo', `precio` = '$precio', `stock` = '$stock', `foto` = '$foto', `detalles` = '$detalles', `tipo` = '$tipo' WHERE (`id` = '$idArticulo')";
		    $resultadoConsulta = mysqli_query($conexion,$consulta);
            if(!$resultadoConsulta){
                throw new Exception(mysqli_error($conexion)); 
            }
  
            foreach($selectValor as $key => $value){
                if($value!="vacio"){
                    $stmt = mysqli_prepare($conexion, 'INSERT INTO categoria (`idValor`, `idArticulo`) VALUES (?, ?)');
                    mysqli_stmt_bind_param($stmt,'ii', $value, $idArticulo);
                    $ejecutar = mysqli_stmt_execute($stmt);
                    if(!$ejecutar){
                        throw new Exception(mysqli_error($conexion)); 
                    }
                }
            }
            //Una vez todo esté correcto se ejecutarán todas las consultas
            mysqli_commit($conexion);

        } 
        //Recogerá el error y no se realizará ninguna consulta
        catch (Exception $e) {
            mysqli_rollback($conexion);
            throw $e;
        }
    }

    //Función para filtrar por el tipo seleccionado, distinct es para evitar que se repita el artículo
    function filtroOpciones($conexion,$tipo){
        $consulta = "SELECT DISTINCT opcion.id, opcion.nombre FROM opcion inner join valor on valor.idOpcion = opcion.id inner join categoria on categoria.idValor = valor.id inner join articulo on articulo.id = categoria.idArticulo WHERE(articulo.tipo = '$tipo')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);        
		return $resultadoConsulta;
    }

    //Función para filtrar por la opción introducida y por el tipo, para seleccionar el valor id y el valor nombre
    function filtroValores($conexion,$idOpcion,$tipo){
        $consulta = "SELECT DISTINCT valor.id,valor.nombre FROM valor inner join opcion on opcion.id = valor.idOpcion inner join categoria on categoria.idValor = valor.id inner join articulo on articulo.id = categoria.idArticulo WHERE(idOpcion = '$idOpcion' AND tipo = '$tipo')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);        
		return $resultadoConsulta;
    }

    //Función para seleccionar los articulos según el tipo
    function filtroArticulos($conexion,$tipo){
        $consulta = "SELECT * FROM articulo WHERE(tipo = '$tipo')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);        
		return $resultadoConsulta;
    }

    //Función para filtrar según el valor introducido y seleccionar el artículo deseado
    function filtro($conexion,$idValor,$tipo){
        $consulta = "SELECT * FROM articulo inner join categoria on categoria.idArticulo = articulo.id inner join valor on categoria.idValor = valor.id WHERE(valor.id = '$idValor' AND articulo.tipo = '$tipo')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);        
		return $resultadoConsulta;
    }

    //Función para seleccionar los datos del articulo sin repetirse por el distinct, según el valor y el tipo introducido
    function articuloPorFiltro($conexion,$valores,$tipo){
        $consulta = "SELECT DISTINCT articulo.id,articulo.nArticulo,articulo.precio,articulo.precio,articulo.stock,articulo.foto,articulo.detalles,articulo.tipo FROM articulo inner join categoria on categoria.idArticulo = articulo.id inner join valor on valor.id = categoria.idValor Where valor.id IN (".implode(',',$valores).") AND tipo = '$tipo'";
		$resultadoConsulta = mysqli_query($conexion,$consulta);  
		return $resultadoConsulta;
    }

    //Función para realizar la búsqueda en la barra de navegación
    function busquedaArticulo($conexion,$busqueda){
        $consulta = "SELECT * FROM articulo WHERE nArticulo LIKE '%$busqueda%'";
		$resultadoConsulta = mysqli_query($conexion,$consulta);  
		return $resultadoConsulta;
    }

    //Función para introducir el me gusta o no me gusta en la tabla megustas
    function meGustaArticulo($conexion,$idArticulo,$idUsuario,$valoracion){
        $consulta = "INSERT INTO megustas (idArticulo,idUsuario,gusta) VALUES($idArticulo,$idUsuario,$valoracion) ON DUPLICATE KEY UPDATE gusta = $valoracion";
		$resultadoConsulta = mysqli_query($conexion,$consulta);  
		return $resultadoConsulta;
    }

    //Funcion para ver los likes del usuario en concreto en un artículo en concreto
    function verLikeDeArticulo($conexion,$idArticulo,$idUsuario){
        $consulta = "SELECT * FROM megustas WHERE(idArticulo = '$idArticulo') AND (idUsuario = '$idUsuario')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);  
		return $resultadoConsulta;
    }

    //Función para ver editar los likes
    function editarLike($conexion,$valoracion,$idArticulo,$idUsuario){
        $consulta = "UPDATE megustas SET `gusta` = '$valoracion' WHERE (`idUsuario` = '$idUsuario') AND (`idArticulo` = '$idArticulo')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);  
		return $resultadoConsulta;
    }

    //Función para ver los likes del artículo
    function verMeGustaTotal($conexion,$idArticulo){
        $consulta = "SELECT gusta FROM megustas WHERE(idArticulo = '$idArticulo')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);  
		return $resultadoConsulta;
    }

    //Función para borrar el like según su id
    function deseleccionar($conexion,$idLike){
        $consulta = "UPDATE megustas SET `gusta` = '0' WHERE (`id` = '$idLike')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);  
		return $resultadoConsulta;
    }

    //Función para borrar el comentario según su id
    function borrarComentario($conexion,$id){
        $consulta = "DELETE FROM comentario WHERE (id = '$id')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);  
		return $resultadoConsulta;
    }

    //Función para sumar los likes de un artículo donde sea 1, es decir que tenga un like
    function sumaVerLikes($conexion,$idArticulo){
        $consulta = "SELECT count(gusta) FROM megustas WHERE (gusta = 1) AND (idArticulo = '$idArticulo')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);  
		return $resultadoConsulta;
    }

    //Función para sumar los dislikes de un artículo donde sea -1, es decir que tenga un dislike
    function sumarVerDislikes($conexion,$idArticulo){
        $consulta = "SELECT count(gusta) FROM megustas WHERE (gusta = '-1') AND (idArticulo = '$idArticulo')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);  
		return $resultadoConsulta;
    }

    //Función para coger los 5 artículos con más likes 
    function imagenesCarrouselMasVotados($conexion){
        $consulta = "SELECT DISTINCT idArticulo,foto,tipo FROM megustas inner join articulo on articulo.id = megustas.idArticulo Order BY gusta  DESC  LIMIT 5";
		$resultadoConsulta = mysqli_query($conexion,$consulta);  
		return $resultadoConsulta;
    }

    //Función para coger los 5 artículos más nuevos, es decir, que su id sea la más alta
    function imagenesCarrouselMasNuevos($conexion){
        $consulta = "SELECT * FROM articulo Order BY id  DESC  LIMIT 5";
		$resultadoConsulta = mysqli_query($conexion,$consulta);  
		return $resultadoConsulta;
    }
    
?>
