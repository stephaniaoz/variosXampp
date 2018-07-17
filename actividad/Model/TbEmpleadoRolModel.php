<?php


include_once('C:\xampp\htdocs\actividad\db\database_utilidades.php');
/**
*
*/

class TbEmpleadoRolModel{

	public function setEmpleadoRol($rol,$idUsu){


		$conexion = conectar();

		$SQL = "INSERT INTO empleados_rol( empleado_id, rol_id) VALUES (".$idUsu.", ".$rol.")";

		$result = $conexion->query($SQL) or die("Error al inserta tb_empleado_rol:".mysqli_error($conexion));

		return $result;

	}

	public function eliminarUsuarioRol($idUsu){
		
		$conexion = conectar();

		$SQL ="DELETE FROM empleados_rol WHERE empleado_id = ".$idUsu;

		$result = $conexion->query($SQL) or die("Error al eliminar empleados_rol:".mysqli_error($conexion));

		return $result;
	}

	public function getRolEmpleado($idUsu){

		$conexion = conectar();

		$SQL ="SELECT * FROM empleados_rol WHERE empleado_id = ".$idUsu;

		$result = $conexion->query($SQL) or die("Error al eliminar empleados_rol:".mysqli_error($conexion));

		return $result;

	}



}

?>