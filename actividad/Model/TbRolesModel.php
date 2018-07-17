<?php

include_once('C:\xampp\htdocs\actividad\db\database_utilidades.php');
/**
*
*/

class TbRolesModel{

	

	public function getAllRoles(){

		$conexion = conectar();

		$SQL = "SELECT * FROM roles ";

		$result = $conexion->query($SQL) or die("Error al seleccionar:". mysqli_error($conexion));

		return $result;
	}



}

?>