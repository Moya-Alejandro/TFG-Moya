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

    function mostrarCategorias($conexion){
        $consulta = "SELECT * FROM opcion";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
		return $resultadoConsulta;
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
    
?>