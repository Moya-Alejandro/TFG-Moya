<?php
    require '../../backend/bd/conectarBD.php';
    require '../../backend/bd/DAOusuario.php';
    $conexion = conectarBd(true);
    session_start();

    $idUsuario = $_SESSION["id"];
    $rolUsuario = $_SESSION["rol"];
    $idArticulo = $_GET["idArticulo"];
    
    $result =  verComentario($conexion,$idArticulo);

    
    $json= array();
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
            'iconoEditar' =>$iconoEditar
        );
    }

    $jsonstring=json_encode($json);

    echo $jsonstring;

?>