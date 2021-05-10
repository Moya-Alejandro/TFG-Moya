<?php 
    
    require "../bd/conectarBD.php";
    require "../bd/DAOcategoria.php";

    $nombre = $_POST["nArticulo"];
    $precio = $_POST["precio"];
    $stock = $_POST["stock"];
    $detalles = $_POST["detalles"];
    $selectValor = $_POST["selectValor"];


    if(empty( $_FILES["imagen"]["name"] )){
        $error = "Suba una foto";
        header("Location: ../../frontend/admin/crearArticulo.php?error=$error");
    }

    $img = $_FILES["imagen"];
    $img_name = $img['name'];
    $img_tmp = $img['tmp_name'];
    $img_size = $img['size'];
    $img_error = $img['error'];

    $img_ext = explode('.',$img_name)[1];
    $permitido = array('png','JPG','jpg','PNG');

    $img_nombre_nuevo = uniqid('', true) . '.' . $img_ext;
    $img_destino = 'img/' . $img_nombre_nuevo;

    if(!in_array($img_ext,$permitido)){
        $error = "La extensión del archivo debe ser PNG o JPG";
        header("Location: ../../frontend/admin/crearArticulo.php?error=$error");
    }

    if($img_error != 0){
        $error = $img_error;
        header("Location: ../../frontend/admin/crearArticulo.php?error=$error");
    }

    if(!move_uploaded_file($img_tmp,"../../frontend/".$img_destino)){
        $error = "No se ha podido guardar la foto";
        header("Location: ../../frontend/admin/crearArticulo.php?error=$error");
    }

    $conexion = conectarBD(true);

    try{
        $subirArticulo = crearCategoriaArt($conexion,$selectValor,$nombre,$precio,$stock,$img_destino,$detalles);
        header("Location: ../../frontend/panel/panelArticulo.php");
    }
    catch(Exception $e){
        $error = $e->getMessage();
        header("Location: ../../frontend/admin/crearArticulo.php?error=$error");
    }
    
?>