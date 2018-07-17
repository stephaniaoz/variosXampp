<?php

include_once('C:\xampp\htdocs\actividad\db\database_utilidades.php');
/**
*
*/

class TbUsuarioModel{

	public function getAllUsuario(){

		$conexion = conectar();

		$SQL = "SELECT e.*, a.nombre AS area_nombre
				FROM empleados e
				LEFT JOIN areas a ON e.area_id = a.id";

		$result = $conexion->query($SQL) or die("Error al seleccionar:". mysqli_error($conexion));

		return $result;
	}



	public function updateUsuario($arrayUsu){

		$conexion = conectar();

		$SQL = "UPDATE empleados SET nombre='".$arrayUsu['nombre']."',email='".$arrayUsu['email']."',sexo='".$arrayUsu['sexo']."',area_id='".$arrayUsu['area_id']."',boletin='".$arrayUsu['boletin']."', descripcion = '".$arrayUsu['descripcion']."' WHERE id = ".$arrayUsu['id'];

		$result = $conexion->query($SQL) or die("Error al actualizar:".mysqli_error($conexion));

		return $result;

	}

	public function insertUsu($arrayUsu){

		$conexion = conectar();

		$SQL = "INSERT INTO empleados ( nombre, email,sexo,  boletin, descripcion, area_id) VALUES ('".$arrayUsu['nombre']."', '".$arrayUsu['email']."', '".$arrayUsu['sexo']."', '".$arrayUsu['boletin']."', '".$arrayUsu['descripcion']."',".$arrayUsu['area_id']." );";

		$result = $conexion->query($SQL) or die("Error al insertar:".mysqli_error($conexion));

		return $result;

	}

	public function deleteUsu($idUsu){

		$conexion = conectar();

		$SQL = "DELETE FROM empleados WHERE id = ".$idUsu;

		$result = $conexion->query($SQL) or die("Error al eliminar:".mysqli_error($conexion));

		return $result;
	}

	public function getIdUsu($nombre){

		$conexion = conectar();

		$SQL = "SELECT * FROM empleados WHERE nombre = '".$nombre."'";

		$result = $conexion->query($SQL) or die("Error al get usu id:".mysqli_error($conexion));

		return $result;
	}


}

?>