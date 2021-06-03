<?php 

    //En caso de que el enlace sea escrito por la barra de búsqueda nos devolverá al index
    if(!isset($_SERVER['HTTP_REFERER'])){
        header("Location: ../../frontend/index/index.php");
        exit;
    }

    //Llamamos a los archivos que contienen funciones de la base de datos para poder utilizar sus funciones
    require '../bd/conectarBD.php';
    require '../bd/DAOusuario.php';

    //Recogemos las variables que se le pasa desde el frontend y la guardamos en una variable
    $idUsuario = $_GET["idUsuario"];
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $telefono = $_POST["telefono"];
    $dni = $_POST["dni"];
    $usuario = $_POST["usuario"];
    $correo = $_POST["correo"];
    $password = $_POST["password"];

    //Guardamos en una variable la función que nos conecta a la base de datos, en este caso verdadera, ya que es en AWS(RDS)
    $conexion = conectarBD(true);
    
    //Hacemos un try catch, en el caso de que se ejecute la función ocurrirá la consulta que hay en el try y nos redirigirá, en el caso contrario, nos mostrará un error
    try{
        editarPerfil($conexion,$usuario,$password,$nombre,$apellidos,$telefono,$correo,$dni,$idUsuario);
        header("Location: ../../frontend/panel/panelUsuario.php");
    }
    catch(Exception $e){
        $error = "Este usuario ya existe";
        header("Location: ../../frontend/admin/editarUsuario.php?idUsuario=$idUsuario&error=$error");
    }

?>