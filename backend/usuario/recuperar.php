<?php 
    require '../bd/conectarBD.php';
    require '../bd/DAOusuario.php';
    
	$conexion = conectarBD(true);

    $correo = $_POST["correo"];

    //Generamos una contraseña nueva temporal y la actualizamos en la base de datos
    $contra = generarContraTemporal();
    actualizarContra($conexion,$contra,$correo);

    //Este será el mensaje, el asunto y el encabezado que se mandará por el correo
    $asunto = "Contraseña Olvidada Melilla Shooting";
    $mensaje = "La contraseña de la cuenta ".$correo." es: ".$contra."\nCambie la contraseña en su perfil.";
    $headers = 'From: moya.alejandro2001@gmail.com';
    
    //Para que no haya problemas con las 'ñ'
    $mensaje = utf8_decode($mensaje);
    $asunto = utf8_decode($asunto);
    
    if(mail($correo, $asunto, $mensaje,$headers)){
        $enviado = "Si tu correo electrónico coincide con el de una cuenta existente, te enviaremos un correo para restablecer la contraseña en unos minutos.";
        header("Location: ../../frontend/login/login.php?enviado=$enviado");
    }
    else{
        $enviado = "Ha habido un problema al enviar el correo";
        header("Location: ../../frontend/login/login.php?enviado=$enviado");
    }

?>
