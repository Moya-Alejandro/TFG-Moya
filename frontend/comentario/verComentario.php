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

    //Iniciamos una sesión para poder coger parametros a través de las variables locales
    session_start();

    //Recogemos las variables que se le pasa desde el frontend y la guardamos en una variable
    $idUsuario = $_GET["idUsuario"];
    $rolUsuario = $_SESSION["rol"];
    $idArticulo = $_GET["idArticulo"];
    
    //Guardamos en una variable la consulta
    $result =  verComentario($conexion,$idArticulo);
    $usuario = mysqli_fetch_array(verNomberComentario($conexion,$idUsuario));

    //Creamos un array
    $json= array();

    //Mientras existan comentarios se irán guardando en el array
    while($ver= mysqli_fetch_array($result)){
        $idComentario = $ver['id'];
        $comentario = $ver['comentario'];
        $icono = "<button class='borrarComentario' data-idComentario ='$idComentario'><i class='fas fa-trash'></i></button>";
        $iconoEditar = "<button class='editarComentario' data-idComentario ='$idComentario' data-comentario ='$comentario'><i class='far fa-edit'></i></button>";
        $json[]= array(
            'comentario' => $ver['comentario'],
            'idUsuarioComentario' => $ver['idUsuario'],
            'id' => $ver['idUsuario'],
            'iconoBorrar' => $icono,
            'iconoEditar' =>$iconoEditar,
            'nombreUsuario' =>$usuario['nUsuario']
        );
    }

    //Pasamos de tener un array a un objeto JSON
    $jsonstring=json_encode($json);

    //Los mostramos por Java Script
    echo $jsonstring;

?>