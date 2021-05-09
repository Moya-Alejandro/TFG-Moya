<?php 
    function crearCategoria($conexion,$nombre,$valores){
        mysqli_begin_transaction($conexion);

        try {
            $consulta = "INSERT INTO opcion (`nombre`) VALUES ('$nombre')";
		    $resultadoConsulta = mysqli_query($conexion,$consulta);
            if(!$resultadoConsulta){
                //throw new Exception("Nombre duplicado");
                throw new Exception(mysqli_error($conexion)); //x
            }
            $ultimaId = mysqli_insert_id($conexion);

            foreach($valores as $key => $value){
                $stmt = mysqli_prepare($conexion, 'INSERT INTO valor(nombre,idOpcion) VALUES (?,?)');
                mysqli_stmt_bind_param($stmt,'si', $value, $ultimaId);
                $ejecutar = mysqli_stmt_execute($stmt);
                if(!$ejecutar){
                    throw new Exception(mysqli_error($conexion)); //x
                }
            }
            mysqli_commit($conexion);

        } catch (Exception $e) {
            mysqli_rollback($conexion);
            throw $e;
        }
    }


    function datosCategoria($conexion,$id){
        $consulta = "SELECT opcion.id as idOpcion, opcion.nombre as nombreOpcion, valor.id as idValor, valor.nombre as nombreValor FROM opcion inner join valor on opcion.id = valor.idOpcion WHERE (idOpcion=$id)";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
        if(!$resultadoConsulta){
            header("Location: ../index/index.php");
        }
        $datos = mysqli_fetch_assoc($resultadoConsulta);
        if($datos==0){
            header("Location: ../index/index.php");
        }
		return $datos;
    }

    function borrarCategoria($conexion,$id){
        $consulta = "DELETE FROM opcion WHERE (`id` = '$id')";
        $resultadoConsulta = mysqli_query($conexion,$consulta);
        if(!$resultadoConsulta){
            throw new Exception(mysqli_error($conexion)); //x
        }
        return $resultadoConsulta;
    }

    
    function borrarValor($conexion,$id){
        $consulta = "DELETE FROM valor WHERE (`id` = '$id')";
        $resultadoConsulta = mysqli_query($conexion,$consulta);
        if(!$resultadoConsulta){
            throw new Exception(mysqli_error($conexion)); //x
        }
        return $resultadoConsulta;
    }

    function cogerOpcion($conexion,$id){
        $consulta = "SELECT * FROM opcion WHERE (id=$id)";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
		return $resultadoConsulta;
    }

    function cogerValores($conexion,$id){
        $consulta = "SELECT id,nombre FROM valor WHERE (idOpcion=$id)";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
		return $resultadoConsulta;
    }
    

    function editarCategoria($conexion,$idOpcion,$nombre,$valores,$idValores,$valoresJs){
        mysqli_begin_transaction($conexion);

        try {
            $consulta = "UPDATE opcion SET `nombre` = '$nombre' WHERE (`id` = '$idOpcion')";
		    $resultadoConsulta = mysqli_query($conexion,$consulta);
            if(!$resultadoConsulta){
                //throw new Exception("Nombre duplicado");
                throw new Exception(mysqli_error($conexion)); //x
            }

            foreach($valores as $key => $value){
                $stmt = mysqli_prepare($conexion, 'UPDATE valor SET `nombre` = ? WHERE (`idOpcion` = ?)AND `id` = ?');
                mysqli_stmt_bind_param($stmt,'sii', $value, $idOpcion,$idValores[$key]);
                $ejecutar = mysqli_stmt_execute($stmt);
                if(!$ejecutar){
                    throw new Exception(mysqli_error($conexion)); //x
                }
            }

            if($valoresJs!=null){
                foreach($valoresJs as $key => $value){
                    $stmt = mysqli_prepare($conexion, 'INSERT INTO valor(nombre,idOpcion) VALUES (?,?)');
                    mysqli_stmt_bind_param($stmt,'si', $value, $idOpcion);
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

    function mostrarCategorias($conexion){
        $consulta = "SELECT * FROM opcion";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
		return $resultadoConsulta; 
    }

?>