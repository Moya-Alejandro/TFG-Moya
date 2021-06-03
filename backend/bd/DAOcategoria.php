<?php 

    //Función para crear una categoría con sus valores
    function crearCategoria($conexion,$nombre,$valores,$valoresJs){

        //Esta función no se ejecutará hasta que todo esté correcto
        mysqli_begin_transaction($conexion);

        //Preparamos todas las consultas que necesitamos para crear la categoría
        try {
            $consulta = "INSERT INTO opcion (`nombre`) VALUES ('$nombre')";
		    $resultadoConsulta = mysqli_query($conexion,$consulta);
            if(!$resultadoConsulta){
                throw new Exception(mysqli_error($conexion)); 
            }
            $ultimaId = mysqli_insert_id($conexion);

            foreach($valores as $key => $value){
                $stmt = mysqli_prepare($conexion, 'INSERT INTO valor(nombre,idOpcion) VALUES (?,?)');
                mysqli_stmt_bind_param($stmt,'si', $value, $ultimaId);
                $ejecutar = mysqli_stmt_execute($stmt);
                if(!$ejecutar){
                    throw new Exception(mysqli_error($conexion)); 
                }
            }
            
            if($valoresJs!=null){
                foreach($valoresJs as $key => $value){
                    $stmt = mysqli_prepare($conexion, 'INSERT INTO valor(nombre,idOpcion) VALUES (?,?)');
                    mysqli_stmt_bind_param($stmt,'si', $value, $ultimaId);
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

    //Función para ver la tabla de valores y opciones
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

    //Función para borrar la categoría según su id
    function borrarCategoria($conexion,$id){
        $consulta = "DELETE FROM opcion WHERE (`id` = '$id')";
        $resultadoConsulta = mysqli_query($conexion,$consulta);
        //En caso de que no se borre, mostrará un error
        if(!$resultadoConsulta){
            throw new Exception(mysqli_error($conexion)); 
        }
        return $resultadoConsulta;
    }

    //Función para borrar el valor según su id
    function borrarValor($conexion,$id){
        $consulta = "DELETE FROM valor WHERE (`id` = '$id')";
        $resultadoConsulta = mysqli_query($conexion,$consulta);
        if(!$resultadoConsulta){
            //En caso de que no se borre, mostrará un error
            throw new Exception(mysqli_error($conexion)); 
        }
        return $resultadoConsulta;
    }

    //Función para seleccionar todo los campos de la tabla opción según su id
    function cogerOpcion($conexion,$id){
        $consulta = "SELECT * FROM opcion WHERE (id=$id)";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
		return $resultadoConsulta;
    }

    //Función para seleccionar todo los campos de la tabla valor según su id
    function cogerValores($conexion,$id){
        $consulta = "SELECT id,nombre FROM valor WHERE (idOpcion=$id)";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
		return $resultadoConsulta;
    }
    
    //Función editar la categoria, para editar la tabla opción y valor
    function editarCategoria($conexion,$idOpcion,$nombre,$valores,$idValores,$valoresJs){

        //Esta función no se ejecutará hasta que todo esté correcto
        mysqli_begin_transaction($conexion);

            //Preparamos todas las consultas que necesitamos para editar la categoría
        try {
            $consulta = "UPDATE opcion SET `nombre` = '$nombre' WHERE (`id` = '$idOpcion')";
		    $resultadoConsulta = mysqli_query($conexion,$consulta);
            if(!$resultadoConsulta){
                
                throw new Exception(mysqli_error($conexion)); 
            }

            foreach($valores as $key => $value){
                $stmt = mysqli_prepare($conexion, 'UPDATE valor SET `nombre` = ? WHERE (`idOpcion` = ?)AND `id` = ?');
                mysqli_stmt_bind_param($stmt,'sii', $value, $idOpcion,$idValores[$key]);
                $ejecutar = mysqli_stmt_execute($stmt);
                if(!$ejecutar){
                    throw new Exception(mysqli_error($conexion)); 
                }
            }

            if($valoresJs!=null){
                foreach($valoresJs as $key => $value){
                    $stmt = mysqli_prepare($conexion, 'INSERT INTO valor(nombre,idOpcion) VALUES (?,?)');
                    mysqli_stmt_bind_param($stmt,'si', $value, $idOpcion);
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

    //Seleccionar todos los campos de la tabla opción
    function mostrarCategorias($conexion){
        $consulta = "SELECT * FROM opcion";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
		return $resultadoConsulta; 
    }

    //Función para crear la relación entre las categorías y un artículo
    function crearCategoriaArt($conexion,$idValor,$nArticulo,$precio,$stock,$foto,$detalles,$tipo){
        //Esta función no se ejecutará hasta que todo esté correcto
        mysqli_begin_transaction($conexion);
        //Preparamos todas las consultas que necesitamos para crear la relación
        try {

            $consulta = "INSERT INTO articulo ( `nArticulo`, `precio`, `stock`, `foto`, `detalles`,`tipo`) VALUES ('$nArticulo', '$precio', '$stock', '$foto', '$detalles', '$tipo')";
		    $resultadoConsulta = mysqli_query($conexion,$consulta);
            if(!$resultadoConsulta){
                
                throw new Exception(mysqli_error($conexion)); 
            }
            $ultimaId = mysqli_insert_id($conexion);

            foreach($idValor as $key => $value){
                if($value!="vacio"){
                    $stmt = mysqli_prepare($conexion, 'INSERT INTO categoria (`idValor`, `idArticulo`) VALUES (?, ?)');
                    mysqli_stmt_bind_param($stmt,'ii', $value, $ultimaId);
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
?>