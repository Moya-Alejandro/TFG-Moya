<?php

    if(!isset($_SERVER['HTTP_REFERER'])){
        header("Location: ../../frontend/index/index.php");
        exit;
    }
    
    require "../bd/conectarBD.php";
    require "../bd/DAOarticulo.php";

    $idArticulo = $_POST["idArticulo"];
    $nArticulo = $_POST["nArticulo"];
    $precio = $_POST["precio"];
    $stock = $_POST["stock"];
    $detalles = $_POST["detalles"];
    $selectValor = $_POST["selectValor"];

    $conexion = conectarBD(true);

    //Necesitamos el destino de la foto anterior para borrarlo, o en caso de no actualizarla dejarla igual
    $articulo = mostrarArticuloId($conexion,$idArticulo);
    $fila = mysqli_fetch_assoc($articulo);
    $img_destino = $fila["foto"];

    //En caso de que se actualize la foto comprobamos que no haya errores y borramos la anterior para subir una nueva
    if(!empty( $_FILES["imagen"]["name"] )){
        
        $img = $_FILES["imagen"];
        $img_name = $img['name'];
        $img_tmp = $img['tmp_name'];
        $img_size = $img['size'];
        $img_error = $img['error'];
        $img_ext = explode('.',$img_name)[1];
        $permitido = array('png','JPG','jpg','PNG');
        
        
    
        if(!in_array($img_ext,$permitido)){
            $error = "La extensión del archivo debe ser PNG o JPG";
            header("Location: ../../frontend/admin/editarArticulo.php?idArticulo=$idArticulo&error=$error");
        }
    
        if($img_error != 0){
            $error = $img_error;
            header("Location: ../../frontend/admin/editarArticulo.php?idArticulo=$idArticulo&error=$error");
        }
    
        unlink("../../frontend/".$img_destino);
        $img_nombre_nuevo = uniqid('', true) . '.' . $img_ext;
        $img_destino = 'img/' . $img_nombre_nuevo;
        if(!move_uploaded_file($img_tmp,"../../frontend/".$img_destino)){
            $error = "No se ha podido guardar la foto";
            header("Location: ../../frontend/admin/editarArticulo.php?idArticulo=$idArticulo&error=$error");
        }

       

    }

    

    try{
        $editar = editarArticulo($conexion,$idArticulo,$selectValor,$nArticulo,$precio,$img_destino,$stock,$detalles);
        header("Location: ../../frontend/panel/panelArticulo.php");
    }
    catch(Exception $e){
        $error = $e->getMessage();
        header("Location: ../../frontend/admin/editarCategoria.php?idCategoria=$idArticulo&error=$error");
    }

?>