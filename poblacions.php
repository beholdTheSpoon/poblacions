<?php
	$host = "localhost";
	$usuariBBDD = "root";
	$contrasenya = "";
	$basededades = "informacio";

	//Retornem nomes la provincia passat per paràmetre
	if( isset($_GET['provincies']) ){
		$mysqli = new mysqli($host, $usuariBBDD, $contrasenya, $basededades);
		$sql = "SELECT * FROM provincies";
		if ( ! $result = $mysqli->query($sql) ) {
			echo "No s'ha pogut realitzar la consulta";
			echo mysqli_error();
			exit;
		}
		$dades = array();
		while ($row = $result->fetch_assoc()){
			array_push($dades, $row);
		}
		$dades = utf8_converter($dades);
		print json_encode( $dades );
	}
	
	if( isset($_GET['codi']) ){
		$mysqli = new mysqli($host, $usuariBBDD, $contrasenya, $basededades);
		$sql = "SELECT * FROM poblacions WHERE codiProvincia = " . $_GET['codi'];
		if ( ! $result = $mysqli->query($sql) ) {
			echo "No s'ha pogut realitzar la consulta";
			echo mysqli_error();
			exit;
		}
		$dades = array();
		while ($row = $result->fetch_assoc()){
			array_push($dades, $row);
		}
		$dades = utf8_converter($dades);
		print json_encode( $dades );
	}


	//Conversió recursiva del array a UTF-8
	function utf8_converter($array)
	{
		array_walk_recursive($array, function(&$item, $key){
			if(!mb_detect_encoding($item, 'utf-8', true)){
					$item = utf8_encode($item);
			}
		});
		return $array;
	}

	
?>