<?php 
    //Llamamos a los archivos que contienen funciones de la base de datos para poder utilizar sus funciones
    require '../../backend/bd/conectarBD.php';
    require '../../backend/bd/DAOusuario.php';
    require '../../backend/bd/DAOcarrito.php';

    //Iniciamos una sesión para poder coger parametros a través de las variables locales
    session_start();

    //Guardamos en una variable la función que nos conecta a la base de datos, en este caso verdadera, ya que es en AWS(RDS)
    $conexion = conectarBD(true);

    //Recogemos las variables que se le pasa desde el frontend y la guardamos en una variable
    $idUsuario = $_SESSION['id'];

    //Guardamos en variables, el objeto de la consulta realizada, y después la convertimos en un array
    $numeroArticulos = numeroArticulos($conexion, $idUsuario);
    $totalArticulos = mysqli_fetch_assoc($numeroArticulos);
    
    //Mostraremos por Java Script el número de articulos que hay en la cesta
    echo($totalArticulos['Count(idUsuario)']);

?>