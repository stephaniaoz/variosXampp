<?php

include_once('C:\xampp\htdocs\actividad\db\database_utilidades.php');
/**
*
*/

class TbAreasModel{

	

	public function getAllAreas(){

		$conexion = conectar();

		$SQL = "SELECT * FROM areas ";

		$result = $conexion->query($SQL) or die("Error al seleccionar:". mysqli_error($conexion));

		return $result;
	}



}

?>