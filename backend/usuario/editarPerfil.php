<?php
    //Editamos el perfil actual con los datos introducidos en el html, destruimos la sesion ya que los datos de la sesion actuales son aticuados, y creamos una nueva sesion para actualizar nuestros datos
    require '../bd/conectarBD.php';
    require '../bd/DAOusuario.php';

    session_start();
    
    $Nombre = $_POST["nombre"];
    $Apellidos = $_POST["apellidos"];
    $Telefono = $_POST["telefono"];
    $Dni = $_POST["dni"];
    $Usuario = $_POST["usuario"];
    $Correo = $_POST["correo"];
	$Password = $_POST["password"];
    $id = $_SESSION['id'];

    $conexion = conectarBD(true);
    

    editarPerfil($conexion,$Usuario,$Password,$Nombre,$Apellidos,$Telefono,$Correo,$Dni,$id);
    
    session_destroy();

    $result =  consultarUsuarios($conexion, $Usuario);
    $fila = mysqli_fetch_assoc($result);
    crearSesion($fila);
    
    header("Location: ../../frontend/perfil/perfil.php");
?>