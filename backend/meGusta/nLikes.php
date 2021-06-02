<?php 
    //Llamamos a los archivos que contienen funciones de la base de datos para poder utilizar sus funciones
    require '../bd/conectarBD.php';
	require '../bd/DAOarticulo.php';

    //Recogemos las variables que se le pasa desde el frontend y la guardamos en una variable
    $idArticulo = $_GET["idArticulo"];

    //Guardamos en una variable la función que nos conecta a la base de datos, en este caso verdadera, ya que es en AWS(RDS)
    $conexion = conectarBD(true);

    //Guardamos en una variable el array de la consulta que convertiremos de objeto a array con la función fetch assoc
    $valoracion = mysqli_fetch_assoc(sumaVerLikes($conexion,$idArticulo));
    
    //Hacemos un echo para que se muestre por JavaScript sin necesidad de recargar
    echo $valoracion['sum(gusta)'];
?>