<?php
include_once('C:\xampp\htdocs\actividad\Model\TbUsuarioModel.php');
include_once('C:\xampp\htdocs\actividad\Model\TbEmpleadoRolModel.php');
/**
*
*/

if($_REQUEST){

	$modulo = isset($_POST['modulo'])?$_POST['modulo']:'';

	if($modulo == "actualizar"){

		$arrayUsu = array(
							"id" => $_POST['idUsu'],
							"nombre" => $_POST['nombre'],
							"email" => $_POST['email'],
							"sexo" => $_POST['tipo_sexo'],
							"boletin" => $_POST['tipo_boletin'],
							"descripcion" => $_POST['descripcion'],
							"area_id" => $_POST['selecArea'],
							"roles" => $_POST['roles']					


						);

		$objtController = new TbUsuarioController();
		$objtController->actualizarUsuario($arrayUsu);

	}

	if($modulo == "guardar"){

		$arrayUsu = array(
							"nombre" => $_POST['nombre'],
							"email" => $_POST['email'],
							"sexo" => $_POST['tipo_sexo'],
							"boletin" => $_POST['tipo_boletin'],
							"descripcion" => $_POST['descripcion'],
							"area_id" => $_POST['selecArea'],
							"rol"=>$_POST['rol']
						);

		$objtController = new TbUsuarioController();
		$objtController->crearUsuario($arrayUsu);

	}

	if($modulo == "eliminar"){

		$objtController = new TbUsuarioController();
		$objtController->eliminarUsuario($_POST['idUsu']);

	}
}
class TbUsuarioController{

	private $arrayAllUsu = array();

	public function listAllUsuarios(){

		$objetModel = new TbUsuarioModel();
		$result = $objetModel->getAllUsuario();

		$count = 0;


		while ($arrayUsu = mysqli_fetch_assoc($result)) {

			$this->arrayAllUsu[$count]['id'] = $arrayUsu['id'];
			$this->arrayAllUsu[$count]['nombre'] = $arrayUsu['nombre'];
			$this->arrayAllUsu[$count]['email'] = $arrayUsu['email'];
			$this->arrayAllUsu[$count]['sexo'] = $arrayUsu['sexo'];
			$this->arrayAllUsu[$count]['area_id'] = $arrayUsu['area_id'];
			$this->arrayAllUsu[$count]['area_nombre'] = $arrayUsu['area_nombre'];
			$this->arrayAllUsu[$count]['boletin'] = $arrayUsu['boletin'];
			$this->arrayAllUsu[$count]['descripcion'] = $arrayUsu['descripcion'];

			$count++;
		}

		return $this->arrayAllUsu;
	}

	public function actualizarUsuario($arrayUsu){

		$roles = explode(",", $arrayUsu['roles']);

		$objetModel = new TbUsuarioModel();
		$result = $objetModel->updateUsuario($arrayUsu);



		if($result){

			$errores = "";

			$objetModelUsuR = new TbEmpleadoRolModel();
			$objetModelUsuR ->eliminarUsuarioRol($arrayUsu['id']);
			
			for($i=0; $i<count($roles)-1; $i++){

				
				$resultUsuR = $objetModelUsuR->setEmpleadoRol($roles[$i],$arrayUsu['id']);

				if(!$resultUsuR){

					$errores .= $resultUsuR."El usuario esta creado el rol no!!<br>";

				}

			}

			if($errores != ""){

				$objetModel->deleteUsu($arrayUsu['id']);

				return $errores;

			}else{

				echo "Usuario actualizado con rol";			
			}
			

		}else{

			return $result;
		}


	}

	public function crearUsuario($arrayUsu){

		
		$roles = explode(",", $arrayUsu['rol']);

		$objetModel = new TbUsuarioModel();
		$result = $objetModel->insertUsu($arrayUsu);

		if($result){

			

			$resultUsuI = $objetModel->getIdUsu($arrayUsu['nombre']);
			$usuCreado = mysqli_fetch_assoc($resultUsuI);
			$idUsu = $usuCreado['id'];
			
			$errores = "";


			for($i=0; $i<count($roles)-1; $i++){

				$objetModel = new TbEmpleadoRolModel();
				$resultUsuR = $objetModel->setEmpleadoRol($roles[$i],$idUsu);

				if(!$resultUsuR){

					$errores .= $resultUsuR."El usuario esta creado el rol no!!<br>";

				}

			}

			if($errores != ""){

				$objetModel->deleteUsu($idUsu);

				return $errores;

			}else{

				echo "Usuario creado con rol";			
			}
			

			

		}else{

			return $result;
		}

	}

	public function eliminarUsuario($idUsu){

		$objetModelE = new TbEmpleadoRolModel();
		$resultUsuR = $objetModelE->eliminarUsuarioRol($idUsu);

		if($resultUsuR){

			$objetModel = new TbUsuarioModel();
			$result = $objetModel->deleteUsu($idUsu);

			if($result){

				echo "Usuario eliminado con rol";


			}else{

				return $result;
			};

		}else{

			return $resultUsuR;
		}


	}

}

?>