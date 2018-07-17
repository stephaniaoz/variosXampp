<?php
//bhernandez@nexura.com
include_once('C:\xampp\htdocs\actividad\Controller\TbUsuarioController.php');
include_once('C:\xampp\htdocs\actividad\Controller\TbRolesController.php');

?>

<!DOCTYPE html>
<html>
<head>
	<title>CRUD</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">

	<script src="js/jQuery.js" type="text/javascript" ></script>
	<!--<script src="jquery-1.3.2.min.js" type="text/javascript"></script>-->
<body>

<button type = 'submit'  name='Crear' >Crear Empleado</button>

<?php
	$objtController = new TbRolesController();
	$arrayAllRol = $objtController->listAllRoles();

?>

<div class="Ventana">

	<div class="Content-Ingresar">
		<a href="index1.php" >cerrar</a><br>
		<table>
			<tr>
				<td>Nombre</td>
				<td><input type="text" name="nombre" placeholder="nombre" required></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><input type="email" name="email" placeholder="email" required></td>
			</tr>
			<tr>
				<td>Sexo</td>
				<td><input type="radio" name="tipo_sexo" value="F">Femenino<br>
				<input type="radio" name="tipo_sexo" value="M">Masculino</td><br>
			</tr>
			<tr>
				<td>Area</td>
				<td>
					<select name = "selecArea">
						
					</select>
				</td>
			</tr>
			<tr>
				<td>Deseo recibir el boletin informativo</td>
				<td>
					<input type="checkbox" name="tipo_boletin" value="1">SI
				</td><br>
			</tr>
			<tr>
				<td>Roles</td>
				<td id = 'content_roles'>
<?php foreach ($arrayAllRol as $key => $value) {

			echo "<input type='checkbox' name='tipo_rol' value='".$value['id']."'>".$value['rol_nombre']."<br>";
}
?>
				</td>
			</tr>
			<tr>
				<td>Descripcion</td>
				<td>
					<textarea rows="4" cols="25" name="descripcion" placeholder="Descripcion de la experiencia del empleado"></textarea>
				</td>
			</tr>
			<tr>
				<td><button type = 'submit'  name='actualizar' style='display: none'>Actualizar</button>
				<button type = 'submit'  name='guardar' style='display: none'>Guardar</button></td>
			</tr>

		</table>

	</div>

</div>
<?php
	$objtController = new TbUsuarioController();
	$arrayAllUsu = $objtController->listAllUsuarios();

	if(count($arrayAllUsu) > 0 ){
?>


	<div>

		<table class = "tablaDatos" border="2">
			<thead>
				<tr>

					<th>Nombre</th>


					<th>Email</th>


					<th>Sexo</th>


					<th>Area</th>


					<th>Boletin</th>
					
					

					<th>Descripcion</th>

					<th>Actualizar</th>

					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>

<?php
$count = 0;
foreach ($arrayAllUsu as $key => $value) {

				echo "
					<tr>
						<td class='nombre".$count."' id='".$value['nombre']."'>".$value['nombre']."</td>
						<td class='email".$count."' id='".$value['email']."'>".$value['email']."</td>
						<td class='sexo".$count."' id='".$value['sexo']."'>".$value['sexo']."</td>
						<td class='area".$count."' id='".$value['area_id']."'>".$value['area_nombre']."</td>";
		if($value['boletin'] == "1"){

				echo "<td class='boletin".$count."' id='".$value['boletin']."'> SI </td>";
		}else{
				echo "<td class='boletin".$count."' id='".$value['boletin']."'> NO </td>";
		}


				echo "
				<td class='descripcion".$count."' id='".$value['descripcion']."'>".$value['descripcion']."</td>
				<td><button type = 'submit' class='".$count."' id='".$value['id']."' name='update'>Actualizar</button></td>
				<td><button type = 'submit'  id='".$value['id']."' name='delete'>Eliminar</button></td>
				</tr>";
$count++;

}?>




			</tbody>
		</table>


	</div>
<?php }else{ echo "No hay usuario registrados!!"; }?>


</body>

</html>