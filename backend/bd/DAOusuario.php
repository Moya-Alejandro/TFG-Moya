<?php 

	function insertarUsuarios($conexion,$usuario,$password,$nombre,$apellidos,$telefono,$email,$dni){
		$consulta = "INSERT INTO usuario (`nUsuario`, `password`, `nombre`, `apellidos`, `correo`, `dni`, `telefono`, `rol`) VALUES ('$usuario', '$password', '$nombre', '$email', '$dni', '$telefono', 'usuario', '$apellidos')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
		return $resultadoConsulta;
	}

	function consultarUsuarios($conexion, $usuario){
		$consulta = "SELECT * FROM usuario WHERE nUsuario = '$usuario'";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
		return $resultadoConsulta;
	}

	//Selecciona todos los datos de un usuario y una contraseña si existe
    function consultaLogin($conexion,$usuario,$password){
		$consulta = "SELECT * FROM usuario WHERE nUsuario='$usuario' AND password='$password'";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
		return $resultadoConsulta;
	}

	
	//Guardamos en la super variable $_SESSION, los datos de la sesion actual
    function crearSesion($f){
        session_id($f['dni']);
        session_start();
        $_SESSION['id'] = $f['id'];
        $_SESSION['nUsuario'] = $f['nUsuario'];
        $_SESSION['password'] = $f['password'];
        $_SESSION['nombre'] = $f['nombre'];
		$_SESSION['apellidos'] = $f['apellidos'];
		$_SESSION['telefono'] = $f['telefono'];
        $_SESSION['correo'] = $f['correo'];
        $_SESSION['rol'] = $f['rol'];
		$_SESSION['dni'] = $f['dni'];
	}

	function mostrarUsuarios($conexion){
		$consulta = "SELECT * FROM usuario WHERE (rol = 'usuario')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
		return $resultadoConsulta;
	}



?>