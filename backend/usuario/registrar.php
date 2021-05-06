<?php
	//Enlazamos el archivo donde tenemos las funciones
    require '../bd/conectarBD.php';
    require '../bd/DAOusuario.php';

	//Guardamos en variables los datos que recibimos del html
	$Usuario = $_POST["usuario"];
	$Password = $_POST["password"];
    $Nombre = $_POST["nombre"];
    $Apellidos = $_POST["apellidos"];
    $Telefono = $_POST["telefono"];
	$Email = $_POST["email"];
	$Dni = $_POST["dni"];


	//Nos conectamos al gestor de base de datos
	$conexion = conectarBD(true);

	// Guardamos en una variable la consulta, en este caso la de crear un usuario en la base de datos
	$result = insertarUsuarios($conexion,$Usuario,$Password,$Nombre,$Apellidos,$Telefono,$Email,$Dni);

	// En caso de que se haya creado la cuenta correctamente, te dirije al html con el login
	if ($result) {
		header("Location: ../../frontend/index/index.php"); 
	}
	//En caso de que la cuenta ya exista te devolverá a la misma página de registro
	else{
		header("Location: ../../frontend/registrar/registrar.php"); 
	}

?>
