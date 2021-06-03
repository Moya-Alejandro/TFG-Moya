<?php
    //En caso de que el enlace sea escrito por la barra de búsqueda nos devolverá al index
    if(!isset($_SERVER['HTTP_REFERER'])){
        header("Location: ../../frontend/index/index.php");
        exit;
    }
    
    //Llamamos a los archivos que contienen funciones de la base de datos para poder utilizar sus funciones
    require '../../backend/bd/conectarBD.php';
    require '../../backend/bd/DAOusuario.php';

    //Guardamos en una variable la función que nos conecta a la base de datos, en este caso verdadera, ya que es en AWS(RDS)
    $conexion = conectarBd(true);

    //Recogemos las variables que se le pasa desde el frontend y la guardamos en una variable
    $idArticulo = $_GET["idArticulo"];
    
    //Guardamos en una variable la consulta
    $result =  verComentario($conexion,$idArticulo);

    //Creamos un array
    $json= array();

    //Mientras existan comentarios se irán guardando en el array
    while($ver= mysqli_fetch_array($result)){
        $json[]= array(
            'comentario' => $ver['comentario']
        );
    }

    //Pasamos de tener un array a un objeto JSON
    $jsonstring=json_encode($json);

    //Los mostramos por Java Script
    echo $jsonstring;

?>