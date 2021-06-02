<?php 
    //Llamamos a los archivos que contienen funciones de la base de datos para poder utilizar sus funciones
    require '../bd/conectarBD.php';
	require '../bd/DAOarticulo.php';

    //Iniciamos una sesión para poder coger parametros a través de las variables locales
    session_start();

    //Recogemos las variables que se le pasa desde el frontend y la guardamos en una variable
    $idUsuario = $_SESSION["id"];
    $idArticulo = $_POST["idArticulo"];
    $valor = $_POST["valor"];

    //Guardamos en una variable la función que nos conecta a la base de datos, en este caso verdadera, ya que es en AWS(RDS)
    $conexion = conectarBD(true);

    //Guardamos en una variable la función de la consulta
    $fila = verLikeDeArticulo($conexion,$idArticulo,$idUsuario);
    
    //En caso de que exista una fila de esa consulta, la editaremos
    if(mysqli_num_rows($fila)){
        $editarLike = editarLike($conexion,$valor,$idArticulo,$idUsuario);
    }

    //En caso contrario la crearemos
    else{
        $meGusta = meGustaArticulo($conexion,$idArticulo,$idUsuario,$valor);
    }
    

?>