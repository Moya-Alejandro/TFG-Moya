<?php
    //En caso de que el enlace sea escrito por la barra de búsqueda nos devolverá al index
    if(!isset($_SERVER['HTTP_REFERER'])){
        header("Location: ../../frontend/index/index.php");
        exit;
    }
    
    //Llamamos a los archivos que contienen funciones de la base de datos para poder utilizar sus funciones
    require '../bd/conectarBD.php';
    require '../bd/DAOusuario.php';

    //Iniciamos una sesión para poder coger parametros a través de las variables locales
    session_start();
    
    //Recogemos las variables que se le pasa desde el frontend y la guardamos en una variable
    $Nombre = $_POST["nombre"];
    $Apellidos = $_POST["apellidos"];
    $Telefono = $_POST["telefono"];
    $Dni = $_POST["dni"];
    $Usuario = $_POST["usuario"];
    $Correo = $_POST["correo"];
	$Password = $_POST["password"];
    $id = $_SESSION['id'];

    //Guardamos en una variable la función que nos conecta a la base de datos, en este caso verdadera, ya que es en AWS(RDS)
    $conexion = conectarBD(true);
    
    //Llamamos a la función para que ejecute la consulta
    editarPerfil($conexion,$Usuario,$Password,$Nombre,$Apellidos,$Telefono,$Correo,$Dni,$id);
    
    //Destruimos la sesión antigua
    session_destroy();

    //En una variable guardamos el objeto que tendría los datos del "nuevo usuario", convertimos el objeto en array, y creamos una sesión nueva con los nuevos datos
    $result =  consultarUsuarios($conexion, $Usuario);
    $fila = mysqli_fetch_assoc($result);
    crearSesion($fila);
    
    //Nos redirijirá al perfil
    header("Location: ../../frontend/perfil/perfil.php");
?>