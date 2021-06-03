<?php

    //En caso de que el enlace sea escrito por la barra de búsqueda nos devolverá al index
    if(!isset($_SERVER['HTTP_REFERER'])){
        header("Location: ../../frontend/index/index.php");
        exit;
    }
	
	//Llamamos a los archivos que contienen funciones de la base de datos para poder utilizar sus funciones
    require '../bd/conectarBD.php';
    require '../bd/DAOusuario.php';
	require '../bd/DAOcarrito.php';

	//Iniciamos una sesión para poder coger parametros a través de las variables locales
	session_start();
	//Recogemos las variables que se le pasa desde el frontend y la guardamos en una variable
	$rol = $_SESSION["rol"];
	
	//Si recibe el captcha se hace lo siguiente
	if(!empty($_POST['g-recaptcha-response']) || $rol == "admin"){
		//La llave secreta la cogemos desde google-captcha, la necesitaremos para que funcione el capcha

		$llaveSecreta = "6LcnV-UaAAAAAC7V4L--cgk-Sz_jvMwthEKupzzg";
		//Valores para validar el captcha

		$ip = $_SERVER['REMOTE_ADDR'];
		$response = $_POST['g-recaptcha-response'];

		//Url donde se confirmará la validación para que el captcha funcio
		$url = "https://www.google.com/recaptcha/api/siteverify?secret=$llaveSecreta&response=$response&remoteip=$ip";

		//Recoge el contenido del valor $url
		$fire = file_get_contents($url);

		//Convierte $fire que es un string en una variable php
		$data = json_decode($fire);

		//En caso de que la validación sea correcta haremos el registro
		if($data->success==true || $rol == "admin"){

			//Inicializamos la variable rol en invitado
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
			$ultimoId = mysqli_insert_id($conexion);
			// En caso de que se haya creado la cuenta correctamente, te dirije al html con el login
			if ($result && $rol ="admin") {
				header("Location: ../../frontend/panel/panelUsuario.php"); 
			}
			elseif($result){
				header("Location: ../../frontend/index/index.php"); 
			}
			//En caso de que la cuenta ya exista te devolverá a la misma página de registro
			else{
				$errorSwal = "El usuario ya existe";
				header("Location: ../../frontend/registrar/registrar.php?errorSwal=$errorSwal"); 
			}
		}
		else{
			//Mostrará un mensaje de que rellenemos el captcha si no lo hemos hecho
			$error = "Rellene el Captcha";
			header("Location: ../../frontend/registrar/registrar.php?error=$error"); 
		}
	}
	else{
		//Mostrará un mensaje en el caso de que haya un fallo con el captcha
		$error = "Error en el captcha";
		header("Location: ../../frontend/registrar/registrar.php?error=$error"); 
	}

?>
