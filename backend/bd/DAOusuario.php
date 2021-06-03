<?php 

	function insertarUsuarios($conexion,$usuario,$password,$nombre,$apellidos,$telefono,$email,$dni){
		$consulta = "INSERT INTO usuario (`nUsuario`, `password`, `nombre`, `apellidos`, `correo`, `dni`, `telefono`, `rol`) VALUES ('$usuario', '$password', '$nombre','$apellidos', '$email', '$dni', '$telefono', 'usuario')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
		return $resultadoConsulta;
	}

	function consultarUsuarios($conexion, $usuario){
		$consulta = "SELECT * FROM usuario WHERE (nUsuario = '$usuario')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
		return $resultadoConsulta;
	}

	function consultaUsuarioId($conexion,$idUsuario){
		$consulta = "SELECT * FROM usuario WHERE (id = '$idUsuario')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
		return $resultadoConsulta;
	}

	//Selecciona todos los datos de un usuario y una contraseña si existe
    function consultaLogin($conexion,$usuario,$password){
		$consulta = "SELECT * FROM usuario WHERE (nUsuario='$usuario' AND password='$password')";
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

	//Función para mostrar los usuarios que solo sean rol usuario
	function mostrarUsuarios($conexion){
		$consulta = "SELECT * FROM usuario WHERE (rol = 'usuario')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
		return $resultadoConsulta;
	}

	//Función para editar el perfil
    function editarPerfil($conexion,$usuario,$password,$nombre,$apellidos,$telefono,$correo,$dni,$id){
		$consulta = "UPDATE usuario SET `nUsuario` = '$usuario', `password` = '$password', `nombre` = '$nombre', `apellidos` = '$apellidos', `correo` = '$correo', `dni` = '$dni', `telefono` = '$telefono' WHERE (`id` = '$id')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
		return $resultadoConsulta;
	}

	//Función para eliminar un usuario por su id
	function eliminarIdUsuario($conexion,$id){
		$consulta = "DELETE FROM usuario WHERE (`id` = '$id')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
		return $resultadoConsulta;
	}

	//Función para dar administrador a un usuario
	function darAdmin($conexion,$id){
		$consulta = "UPDATE usuario SET `rol` = 'admin' WHERE (`id` = '$id')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
		return $resultadoConsulta;
	}

	//Función para insertar en la tabla comentario, un valor de comentario nuevo
	function insertarComentario($conexion,$idUsuario,$idArticulo,$comentario){
		$consulta = "INSERT INTO comentario (`idUsuario`, `idArticulo`, `comentario`) VALUES ('$idUsuario', '$idArticulo', '$comentario')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
		return $resultadoConsulta;
	}

	//Función para generar una contraseña temporal al recuperar contraseña
	function generarContraTemporal($longitud = 9) {
		$caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$longitudCaracteres = strlen($caracteres);
		$contraGenerada = '';
		for ($i = 0; $i < $longitud; $i++) {
			$contraGenerada .= $caracteres[rand(0, $longitudCaracteres - 1)];
		}
		return $contraGenerada;
	}

	//Función para actualizar la contraseña
	function actualizarContra($conexion,$contra,$correo){
		$consulta = "UPDATE usuario SET `password` = '$contra' WHERE (`correo` = '$correo')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
		return $resultadoConsulta;
	}

	//Función para mostrar los comentarios según el artículo en el que estemos
	function verComentario($conexion,$idArticulo){
		$consulta = "SELECT * FROM comentario WHERE(idArticulo = '$idArticulo')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
		return $resultadoConsulta;
	}

	//Función para borrar un comentario según su id
	function borrarComentario($conexion,$idComentario){
		$consulta = "DELETE FROM comentario WHERE (`id` = '$idComentario')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
		return $resultadoConsulta;
	}

	//Función para editar un comentario según su id
	function editarComentario($conexion,$idComentario,$comentario){
		$consulta = "UPDATE comentario SET `comentario` = '$comentario' WHERE (`id` = '$idComentario')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
		return $resultadoConsulta;
	}

	//Función para seleccionar los datos de un usuario según el email introducido	
	function recuperarContraCuenta($conexion,$correo){
		$consulta = "SELECT * FROM usuario WHERE correo = '$correo'";
		$resultadoConsulta = mysqli_query($conexion,$consulta);
		return $resultadoConsulta;
	}

	//Función para ver el nombre del comentario
	function verNomberComentario($conexion,$idUsuario){
        $consulta = "SELECT nUsuario FROM comentario inner join usuario on comentario.idUsuario = usuario.id WHERE (idUsuario = '$idUsuario')";
		$resultadoConsulta = mysqli_query($conexion,$consulta);  
		return $resultadoConsulta;
    }
?>
