<?php
	//Enlazamos el archivo donde tenemos las funciones
    require '../bd/conectarBD.php';
    require '../bd/DAOusuario.php';
    $rol = "invitado";
	
	//En caso de tener rol de admin (es decir has creado la cuenta desde el panel, usaremos esta variable para redirigirte al panel)

	if(session_start()&&isset($_SESSION["rol"])){
		$rol = $_SESSION["rol"];
    }
	
	//Guardamos en variables los datos que recibimos del html
	$Usuario = $_POST["usuario"];
	$Password = $_POST["password"];
    $Nombre = $_POST["nombre"];
    $Apellidos = $_POST["apellidos"];
    $Telefono = $_POST["telefono"];
	$Correo = $_POST["correo"];
	$Dni = $_POST["dni"];
	


	//Nos conectamos al gestor de base de datos
	$conexion = conectarBD(true);

	// Guardamos en una variable la consulta, en este caso la de crear un usuario en la base de datos
	$result = insertarUsuarios($conexion,$Usuario,$Password,$Nombre,$Apellidos,$Telefono,$Correo,$Dni);

	// En caso de que se haya creado la cuenta correctamente, te dirije al html con el login
	if ($result && $rol ="admin") {
		header("Location: ../../frontend/panel/panelUsuario.php"); 
	}
	elseif($result){
		header("Location: ../../frontend/index/index.php"); 
	}
	//En caso de que la cuenta ya exista te devolverá a la misma página de registro
	else{
		header("Location: ../../frontend/registrar/registrar.php"); 
	}

?>
