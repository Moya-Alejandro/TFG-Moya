<?php 
    //En caso de que el enlace sea escrito por la barra de búsqueda nos devolverá al index
    if(!isset($_SERVER['HTTP_REFERER'])){
        header("Location: ../../frontend/index/index.php");
        exit;
    }
    
    //Para recuperar la contraseña por email, utilizaremos una biblioteca que se llama PHPMailer, hemos descargado sus archivos y los utilizaremos
    use PHPMailer\PHPMailer\PHPMailer;
    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";

    //Llamamos a los archivos que contienen funciones de la base de datos para poder utilizar sus funciones
    require '../bd/conectarBD.php';
    require '../bd/DAOusuario.php';
    
    //Guardamos en una variable la función que nos conecta a la base de datos, en este caso verdadera, ya que es en AWS(RDS)
	$conexion = conectarBD(true);

    //Recogemos las variables que se le pasa desde el frontend y la guardamos en una variable
    $correo = $_GET["correo"];

    //Generamos una contraseña nueva temporal y la actualizamos en la base de datos
    $contra = generarContraTemporal();
    //Añadiremos un @ al final para que cumpla con los requisitos de la contraseña que queremos
    $contra .= "@";
    actualizarContra($conexion,$contra,$correo);

    //Guardamos en variables los distintos campos que se necesitan para enviar un correo
    $asunto = "Contraseña Olvidada Melilla Shooting";
    $mensaje = "La contraseña de la cuenta ".$correo." es: ".$contra."<br>Cambie la contraseña en su perfil.";
    $headers = 'From: moya.alejandro2001@gmail.com';
    $nombre = "Melilla Shooting";

    //Utilizamos la funcion utf8_decode para evitar problemas con las ñ y las tildes
    $mensaje = utf8_decode($mensaje);
    $asunto = utf8_decode($asunto);

    //Creamos un objeto PHP Mailer
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

    $verCuenta = recuperarContraCuenta($conexion,$correo);

    //En caso de que se envie el correo nos mostrará un mensaje de que se ha enviado, no hacemos una consulta diciendo si el correo o la cuenta existe ya que podríamos tener problemas de seguridad al dar información de si el correo pertenece a una cuenta o no
    $enviado = "Si su correo electrónico coincide con el de una cuenta existente, te enviaremos un correo con la contraseña actualizada. Recuerde cambiarla en el perfil";
    header("Location: ../../frontend/login/login.php?enviado=$enviado");
    if(mysqli_num_rows($verCuenta)!=0){
        $mail->send();
    }


?>






