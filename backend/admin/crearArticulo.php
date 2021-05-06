<?php 

    
    if( !isset( $_FILES["imagen"] ) && empty( $_FILES["imagen"]["name"] )){
        $mensaje = "Suba una foto";
        header("Location: ../../frontend/admin/crearArticulo.php?mensaje=$mensaje");
    }

    if( isset( $_FILES["imagen"] ) && !empty( $_FILES["imagen"]["name"] )){
        $img = $_FILES["imagen"];

        $img_name = $img['name'];
        $img_tmp = $img['tmp_name'];
        $img_size = $img['size'];
        $img_error = $img['error'];

        $img_ext = explode('.',$img_name)[1];
        $permitido = array('png','JPG','jpg','PNG');

        if(in_array($img_ext,$permitido)){
            if($img_error === 0){
                if($img_size <= 2097152){
                    $img_nombre_nuevo = uniqid('', true) . '.' . $img_ext;
                    $img_destino = '../../frontend/img/' . $img_nombre_nuevo;
                    if(move_uploaded_file($img_tmp,$img_destino)){

                    }
                }
            }
        }
    }
    else{
        
    }

?>