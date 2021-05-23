<?php
    require '../../backend/bd/conectarBD.php';
    require '../../backend/bd/DAOusuario.php';
    $conexion = conectarBd(true);
    session_start();

    $idUsuario = $_SESSION["id"];
    $rolUsuario = $_SESSION["rol"];
    $idArticulo = $_GET["idArticulo"];
    $icono = "";
    $result =  verComentario($conexion,$idArticulo);

    $json= array();

    while($ver= mysqli_fetch_array($result)){

        if($idUsuario == $ver['idUsuario']){
            $icono = '<a href=""><i class="fas fa-trash"></i></a>';
        }
        $json[]= array(
            'comentario' => $ver['comentario'],
            'idUsuarioComentario' => $ver['idUsuario'],
            'iconoBorrar' => $icono
        );
    }

    $jsonstring=json_encode($json);

    echo $jsonstring;

?>