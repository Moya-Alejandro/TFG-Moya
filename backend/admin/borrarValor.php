<?php 

    //En caso de que el enlace sea escrito por la barra de búsqueda nos devolverá al index
    if(!isset($_SERVER['HTTP_REFERER'])){
        header("Location: ../../frontend/index/index.php");
        exit;
    }

    //Llamamos a los archivos que contienen funciones de la base de datos para poder utilizar sus funciones
    require '../bd/conectarBD.php';
    require '../bd/DAOcategoria.php';

    //Recogemos las variables que se le pasa desde el frontend y la guardamos en una variable
    $idValor = $_GET["idValor"];
    $idCategoria = $_GET["idCategoria"];

    //Guardamos en una variable la función que nos conecta a la base de datos, en este caso verdadera, ya que es en AWS(RDS)
    $conexion = conectarBD(true);

    //Hacemos un try catch, en el caso de que se ejecute la función ocurrirá la consulta que hay en el try y nos redirigirá, en el caso contrario, nos mostrará un error
    try{
        $borrar = borrarValor($conexion,$idValor);
        header("Location: ../../frontend/admin/editarCategoria.php?idCategoria=$idCategoria");
    }
    catch(Exception $e){
        $error = "Este valor está enlazado a un artículo, elimine el artículo.";
        header("Location: ../../frontend/admin/editarCategoria.php?idCategoria=$idCategoria&error=$error");
    }


?>