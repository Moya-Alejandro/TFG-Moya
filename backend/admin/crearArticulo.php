<?php 
    
    //En caso de que el enlace sea escrito por la barra de búsqueda nos devolverá al index
    if(!isset($_SERVER['HTTP_REFERER'])){
        header("Location: ../../frontend/index/index.php");
        exit;
    }

    //Llamamos a los archivos que contienen funciones de la base de datos para poder utilizar sus funciones
    require "../bd/conectarBD.php";
    require "../bd/DAOcategoria.php";

    //Recogemos las variables que se le pasa desde el frontend y la guardamos en una variable
    $nombre = $_POST["nArticulo"];
    $precio = $_POST["precio"];
    $stock = $_POST["stock"];
    $detalles = $_POST["detalles"];
    $tipo = $_POST["tipo"];
    $selectValor = $_POST["selectValor"];

    //Guardamos en una variable la función que nos conecta a la base de datos, en este caso verdadera, ya que es en AWS(RDS)
    $conexion = conectarBD(true);

    //En caso de que no se suba una foto nos mostrará un error
    if(empty($_FILES["imagen"]["name"])){
        $error = "Suba una foto";
        header("Location: ../../frontend/admin/crearArticulo.php?error=$error");
        return;
    }

    //Guardamos en variables, los atributos de la imagen
    $img = $_FILES["imagen"];
    $img_name = $img['name'];
    $img_tmp = $img['tmp_name'];
    $img_size = $img['size'];
    $img_error = $img['error'];

    //Aquí guardaremos en un array las extensiones permitidas, y guardaremos en img_ext la ruta de la imagen
    $img_ext = explode('.',$img_name)[1];
    $permitido = array('png','JPG','jpg','PNG');

    //Crearemos una uniqid que será el nombre del archivo y creamos una ruta que es donde se guardarán las imagenes
    $img_nombre_nuevo = uniqid('', true) . '.' . $img_ext;
    $img_destino = 'img/' . $img_nombre_nuevo;

    //En caso de que no sea de la extensión permitida nos mostrará un error
    if(!in_array($img_ext,$permitido)){
        $error = "La extensión del archivo debe ser PNG o JPG";
        header("Location: ../../frontend/admin/crearArticulo.php?error=$error");
        return;
    }

    //En caso de que ocurrá algún error nos lo mostrará
    if($img_error != 0){
        $error = $img_error;
        header("Location: ../../frontend/admin/crearArticulo.php?error=$error");
        return;
    }

    //En caso de que no se pueda guardar la foto por algún motivo, nos mostrará un error
    if(!move_uploaded_file($img_tmp,"../../frontend/".$img_destino)){
        $error = "No se ha podido guardar la foto";
        echo "../../frontend/".$img_destino;
        header("Location: ../../frontend/admin/crearArticulo.php?error=$error");
        return;
    }

    // Hacemos un try catch, en el caso de que se ejecute la función ocurrirá la consulta que hay en el try y nos redirigirá, en el caso contrario, nos mostrará un error
    try{
        $subirArticulo = crearCategoriaArt($conexion,$selectValor,$nombre,$precio,$stock,$img_destino,$detalles,$tipo);
        header("Location: ../../frontend/panel/panelArticulo.php");
    }
    catch(Exception $e){
        $error = "Este artículo ya existe";
        header("Location: ../../frontend/admin/crearArticulo.php?error=$error");
    }
    
?>