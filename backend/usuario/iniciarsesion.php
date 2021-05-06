<?php
	//Enlazamos el archivo donde tenemos las funciones
    require '../bd/conectarBD.php';
    require '../bd/DAOusuario.php';

	//Guardamos en unas variables los datos introducidos en el html
	$Usuario = $_POST["usuario"];
	$Password = $_POST["password"]; 
	
	//Nos conectamos al gestor de base de datos
	$conexion = conectarBD(true);

	//En la variable result guardamos la consulta que comprueba si el usuario y la contraseña existe
	$result = consultaLogin($conexion,$Usuario,$Password);
	//En la variable consultaUsuario guardaremos la consulta que comprueba si el usuario existe independientemente de la contraseña
	$consultaUsuario = consultarUsuarios($conexion,$Usuario);
 
	//En caso de que exista el usuario y la contraseña el login es correcto, crea la sesión del usuario y nos redirige a una página que nos muestra los datos del usuario
	if (mysqli_num_rows($result) != 0) {
		$fila = mysqli_fetch_assoc($result);
		crearSesion($fila);
		header("Location: ../../frontend/index/index.php");
	}
	elseif(mysqli_num_rows($consultaUsuario) != 0){
		$error = "La contraseña es incorrecta";
		header("Location: ../../frontend/login/login.php?error=$error");
	}
	else{
		$error = "La cuenta no existe";
		header("Location: ../../frontend/login/login.php?error=$error");
	}
?>

