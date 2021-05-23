<?php
    require '../../backend/bd/conectarBD.php';
    require '../../backend/bd/DAOusuario.php';
    $conexion = conectarBd(true);
    $idArticulo = $_GET["idArticulo"];

    $result =  verComentario($conexion,$idArticulo);

    $json= array();

    while($ver= mysqli_fetch_array($result)){
        $json[]= array(
            'comentario' => $ver['comentario']
        );
    }

    $jsonstring=json_encode($json);

    echo $jsonstring;

?>