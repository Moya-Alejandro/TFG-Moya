<?php
	// //Enlazamos el archivo donde tenemos las funciones
    require '../bd/conectarBD.php';
    require '../bd/DAOusuario.php';
	require '../bd/DAOcarrito.php';
	session_start();
	$rol = $_SESSION["rol"];
	
	if(!empty($_POST['g-recaptcha-response']) || $rol == "admin"){
		$llaveSecreta = "6LcnV-UaAAAAAC7V4L--cgk-Sz_jvMwthEKupzzg";
		$ip = $_SERVER['REMOTE_ADDR'];
		$response = $_POST['g-recaptcha-response'];
		$url = "https://www.google.com/recaptcha/api/siteverify?secret=$llaveSecreta&response=$response&remoteip=$ip";
		$fire = file_get_contents($url);
		$data = json_decode($fire);
		if($data->success==true || $rol == "admin"){
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
				header("Location: ../../frontend/registrar/registrar.php"); 
			}
		}
		else{
			$error = "Rellene el Captcha";
			header("Location: ../../frontend/registrar/registrar.php?error=$error"); 
		}
	}
	else{
		$error = "Error en el captcha";
		header("Location: ../../frontend/registrar/registrar.php?error=$error"); 
	}

?>
