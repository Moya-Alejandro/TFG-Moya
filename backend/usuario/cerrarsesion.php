<?php 

    //Iniciamos la sesión actual y la destruimos para desloguearnos, después de eso nos redirijirá al index
    session_start();
    session_destroy();
    header("Location: ../../frontend/index/index.php");

?>