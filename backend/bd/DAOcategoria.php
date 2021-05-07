<?php 
    function crearCategoria($conexion,$nombre){
        $consulta = "INSERT INTO opcion (`nombre`) VALUES ('$nombre')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
        print_r($resultadoConsulta);
        $ultimaId = mysqli_insert_id($conexion);
		return $ultimaId;
    }

    function crearValores($conexion,$valores,$id){
        $consulta ="INSERT INTO valor (id, nombre) VALUES";
        $longitud = count($valores);
        $string = "";
        foreach($valores as $key => $value){
            $string .= "($id,$value)";

            if($key<$longitud-1){
                $string .= ",";
            }
        }   
        $consulta .= $string;
        $resultadoConsulta = mysqli_query($conexion,$consulta);
        return $resultadoConsulta;
    }    

?>