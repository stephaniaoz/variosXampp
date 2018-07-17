<?php
include_once('C:\xampp\htdocs\actividad\Model\TbAreasModel.php');
/**
*
*/

if($_REQUEST){

	$modulo = isset($_POST['modulo'])?$_POST['modulo']:'';

	if($modulo == "listar"){

		$objetController = new TbAreasController();
		$objetController->listAllRoles();
	}


}
class TbAreasController{

	

	public function listAllRoles(){

		$objetModel = new TbAreasModel();
		$result = $objetModel->getAllAreas();

		$list = "<option value='0'>Seleccione uno</option>";
		

		while ($arrayAre = mysqli_fetch_assoc($result)) {

			$list .= "<option value='".$arrayAre['id']."'>".$arrayAre['nombre']."</option>";

		}

		echo $list;

	}


}

?>