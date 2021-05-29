<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";

    require '../bd/conectarBD.php';
    require '../bd/DAOusuario.php';
    
	$conexion = conectarBD(true);
    $correo = $_POST["correo"];

    //Generamos una contraseña nueva temporal y la actualizamos en la base de datos
    $contra = generarContraTemporal();
    actualizarContra($conexion,$contra,$correo);

    $asunto = "Contraseña Olvidada Melilla Shooting";
    $mensaje = "La contraseña de la cuenta ".$correo." es: ".$contra."<br>Cambie la contraseña en su perfil.";
    $headers = 'From: moya.alejandro2001@gmail.com';
    $nombre = "Melilla Shooting";

    $mensaje = utf8_decode($mensaje);
    $asunto = utf8_decode($asunto);

    $mail = new PHPMailer();

    //Configuración SMTP
    $mail -> isSMTP();
    $mail -> Host = "smtp.gmail.com";
    $mail -> SMTPAuth = true;
    $mail -> Username = "moya.alejandro2001@gmail.com";
    $mail -> Password = "xundqdwzplusaclh";
    $mail -> Port = 465;
    $mail -> SMTPSecure= "ssl";

    //Configuración email
    $mail -> isHTML(true);
    $mail -> setFrom($correo,$nombre);
    $mail -> addAddress($correo);
    $mail -> Subject = $asunto;
    $mail -> Body = $mensaje;

    if ($mail->send()) {
        $enviado = "La contraseña se ha actualizado, si su correo electrónico coincide con el de una cuenta existente, te enviaremos un correo con la contraseña actualizada. Recuerde cambiarla en el perfil";
        header("Location: ../../frontend/login/login.php?enviado=$enviado");
    } else {
        $enviado = "Ha habido un problema al enviar el correo";
        header("Location: ../../frontend/login/login.php?enviado=$enviado");
    }

?>






