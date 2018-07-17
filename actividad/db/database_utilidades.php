<?php
include_once('database_credenciales.php');



	function conectar()
	{
		$conexion = mysqli_connect(DB_HOST,DB_USU,DB_PASSWORD) or die("Error de conexion: ". mysqli_error($conexion));

		mysqli_select_db($conexion,'bd_crud') or die("No se ecuentra la bd". mysqli_error($conexion));

		return $conexion;
	}
	



?>