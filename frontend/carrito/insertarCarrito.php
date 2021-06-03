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
    $idUsuario = $_SESSION["id"];
    $idArticulo = $_POST["idArticulo"];
    $cantidad = $_POST["cantidad"];

    //Guardamos en una variable el array de la consulta stockArticulo
    $articuloId = mysqli_fetch_assoc(stockArticulo($conexion, $idArticulo));
    
    //Guardamos en una variable el stock del articulo con el id pasado por html
    $stockArticulo = $articuloId["stock"];
    
    //Guardamos en una variable el número de filas de la consulta
    $filaCarrito = mysqli_num_rows(stockCarrito($conexion, $idUsuario, $idArticulo));

    //En caso de que no haya filas, no nos dejará insertar nada al carrito
    if($filaCarrito==0){
        $cantidadCesta = 0;
    }
    //En caso contrario la cantidad de la cestá se igualará a la actual
    else{
        $carritoActual = mysqli_fetch_assoc(stockCarrito($conexion, $idUsuario, $idArticulo));
        $cantidadCesta = $carritoActual["cantidad"];
    }

    //Insertaremos el articulo siempre que la cantidad de la cesta sea inferior al stock 
    if($cantidadCesta < $stockArticulo){ 
        $insertar = insertarArticulo($conexion,$cantidad,$idUsuario,$idArticulo);
    }


?>