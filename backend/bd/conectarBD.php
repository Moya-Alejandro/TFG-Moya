<?php
	//Esta función nos permitirá conectarnos a la base de datos para poder trabajar con ella
	function conectarBd($esRemota){
		//En caso de que esRemota sea verdadero trabajaremos con la base de datos de aws
		if ($esRemota) {
			$servidor = "bdmoyaahmedalejandro.cyiob1dhn7j1.eu-west-3.rds.amazonaws.com";	
			$user = "admin";
			$password = "alumno123";
		}
		//En caso de que sea falso trabajaremos con el localhost
		else{
			$servidor = "localhost:3307";
			$user = "root";
			$password = "root";
		}
		//Guardamos en una variable el nombre de la base de datos
		$bd = "TFG";

		//Creamos el enlace para conectarnos a la bd
		$enlace = mysqli_connect($servidor,$user,$password,$bd);

		//Si la conexión se realiza mostará un mensaje y devolverá la variable
		if ($enlace) {
			return $enlace;		
		}
		//Si no se realiza mostará el error y saldrá del programa
		else{
			echo "Error. La conexión con la BD no se ha podido realizar<br>";
			echo mysqli_connect_error();
			exit;
		}
	}

?>

