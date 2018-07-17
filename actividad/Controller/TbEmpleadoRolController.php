<?php
include_once('C:\xampp\htdocs\actividad\Model\TbEmpleadoRolModel.php');
include_once('C:\xampp\htdocs\actividad\Model\TbRolesModel.php');
/**
*
*/

if($_REQUEST){

	$modulo = isset($_POST['modulo'])?$_POST['modulo']:'';

	if($modulo == 'listar'){

		$idUsu = $_POST['idUsu'];
		$objetController = new TbEmpleadoRolController();
		$objetController->listarEmpleadoRol($idUsu);
	}


}
class TbEmpleadoRolController{

	public function listarEmpleadoRol($idUsu)
	{
		$arraRolEmpleado = array();

		$objetModelRE = new TbEmpleadoRolModel();
		$resultRE = $objetModelRE->getRolEmpleado($idUsu);

		
		$count = 0;

		while ($arrayRolE = mysqli_fetch_assoc($resultRE)) {

			$arraRolEmpleado[$count]['id_rolEmpleado'] = $arrayRolE['rol_id'];

			$count++;
			
		}

		
		$objetModelR = new TbRolesModel();
		$resultR = $objetModelR->getAllRoles();

		$roles = "";


		$bandera = true;

		while ($arrayRol = mysqli_fetch_assoc($resultR)) {

			foreach ($arraRolEmpleado as $key => $value) {
				
				if($value['id_rolEmpleado'] == $arrayRol['id']){

					$roles .= "<input type='checkbox' name='tipo_rol' value='".$arrayRol['id']."' checked>".$arrayRol['nombre']."<br>";

					$bandera = false;
				}

			}

			if($bandera){

					$roles .= "<input type='checkbox' name='tipo_rol' value='".$arrayRol['id']."'>".$arrayRol['nombre']."<br>";

			}else{

				$bandera = true;
			}

			
		}


		
		echo $roles;

		//print_r($arraRolEmpleado);
		

	}


}

?>