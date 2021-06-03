<?php 

    //En caso de que el enlace sea escrito por la barra de búsqueda nos devolverá al index
    if(!isset($_SERVER['HTTP_REFERER'])){
        header("Location: ../../frontend/index/index.php");
        exit;
    }
    
    //Llamamos a los archivos que contienen funciones de la base de datos para poder utilizar sus funciones
    require '../bd/DAOcategoria.php';
    require '../bd/conectarBD.php';

    //Recogemos las variables que se le pasa desde el frontend y la guardamos en una variable
    $nombre = $_POST["nombre"];
    $valores = $_POST["valor"];

    //Iniciamos el array en null ya que podemos poner solo un valor, y en caso de que añadamos más creando inputs se guardará en un array
    $valoresJs = null;
    if(isset($_POST["valorJs"])){
        $valoresJs= $_POST["valorJs"];
    }

    //Guardamos en una variable la función que nos conecta a la base de datos, en este caso verdadera, ya que es en AWS(RDS)
    $conexion = conectarBD(true);

    //Hacemos un try catch, en el caso de que se ejecute la función ocurrirá la consulta que hay en el try y nos redirigirá, en el caso contrario, nos mostrará un error
    try{
        crearCategoria($conexion,$nombre,$valores,$valoresJs);
        header("Location: ../../frontend/panel/panelCategoria.php");
    }
    catch(Exception $e){
        $error = "Esta categoría ya existe";
        header("Location: ../../frontend/admin/crearCategoria.php?error=$error");
    }

?>