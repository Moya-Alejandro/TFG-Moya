<?php

    //En caso de que el enlace sea escrito por la barra de búsqueda nos devolverá al index
    if(!isset($_SERVER['HTTP_REFERER'])){
        header("Location: ../../frontend/index/index.php");
        exit;
    }
    
    //Llamamos a los archivos que contienen funciones de la base de datos para poder utilizar sus funciones
    require "../bd/conectarBD.php";
    require "../bd/DAOarticulo.php";

    //Recogemos las variables que se le pasa desde el frontend y la guardamos en una variable
    $idArticulo = $_POST["idArticulo"];
    $nArticulo = $_POST["nArticulo"];
    $precio = $_POST["precio"];
    $stock = $_POST["stock"];
    $detalles = $_POST["detalles"];
    $tipo = $_POST["tipo"];
    $selectValor = $_POST["selectValor"];

    //Guardamos en una variable la función que nos conecta a la base de datos, en este caso verdadera, ya que es en AWS(RDS)
    $conexion = conectarBD(true);

    //Necesitamos el destino de la foto anterior para borrarlo, o en caso de no actualizarla dejarla igual
    $articulo = mostrarArticuloId($conexion,$idArticulo);
    $fila = mysqli_fetch_assoc($articulo);
    $img_destino = $fila["foto"];

    //En caso de que se actualize la foto comprobamos que no haya errores y borramos la anterior para subir una nueva
    if(!empty( $_FILES["imagen"]["name"] )){
        
        //Guardamos en variables, los atributos de la imagen
        $img = $_FILES["imagen"];
        $img_name = $img['name'];
        $img_tmp = $img['tmp_name'];
        $img_size = $img['size'];
        $img_error = $img['error'];

        //Aquí guardaremos en un array las extensiones permitidas, y guardaremos en img_ext la ruta de la imagen
        $img_ext = explode('.',$img_name)[1];
        $permitido = array('png','JPG','jpg','PNG');
        
        //En caso de que no sea de la extensión permitida nos mostrará un error
        if(!in_array($img_ext,$permitido)){
            $error = "La extensión del archivo debe ser PNG o JPG";
            header("Location: ../../frontend/admin/editarArticulo.php?idArticulo=$idArticulo&error=$error");
            return;
        }
    
        //En caso de que ocurrá algún error nos lo mostrará
        if($img_error != 0){
            $error = $img_error;
            header("Location: ../../frontend/admin/editarArticulo.php?idArticulo=$idArticulo&error=$error");
            return;
        }
    
        //Borramos la foto que teniamos antes
        unlink("../../frontend/".$img_destino);

        //Crearemos una uniqid que será el nombre del archivo y creamos una ruta que es donde se guardarán las imagenes
        $img_nombre_nuevo = uniqid('', true) . '.' . $img_ext;
        $img_destino = 'img/' . $img_nombre_nuevo;

        //En caso de que no se pueda guardar la foto por algún motivo, nos mostrará un error
        if(!move_uploaded_file($img_tmp,"../../frontend/".$img_destino)){
            $error = "No se ha podido guardar la foto";
            header("Location: ../../frontend/admin/editarArticulo.php?idArticulo=$idArticulo&error=$error");
            return;
        }

       
    }
  
    //Hacemos un try catch, en el caso de que se ejecute la función ocurrirá la consulta que hay en el try y nos redirigirá, en el caso contrario, nos mostrará un error
    try{
        $editar = editarArticulo($conexion,$idArticulo,$selectValor,$nArticulo,$precio,$img_destino,$stock,$detalles,$tipo);
        header("Location: ../../frontend/panel/panelArticulo.php");
    }
    catch(Exception $e){
        $error = $e->getMessage();
        header("Location: ../../frontend/admin/editarCategoria.php?idCategoria=$idArticulo&error=$error");
    }

?>