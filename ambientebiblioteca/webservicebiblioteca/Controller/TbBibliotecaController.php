<?php
include("C:xampp\htdocs\webservicebiblioteca\Model\TbBiblioteca.php");

if($_REQUEST){

	$modulo = isset($_REQUEST['modulo'])?$_REQUEST['modulo']:'';
	$componente = isset($_REQUEST['componente'])?$_REQUEST['componente']:'';

	if($modulo == 'informe'){

		if($componente == 'listarDisponibilidad'){
			$obj = new TbBibliotecaController();
			$obj->listarDisponibilidades();
		}

		if($componente == 'listarTiquete'){
			$obj = new TbBibliotecaController();
			$obj->listarTiquetes();
		}

		if($componente == 'listarSolicitud'){
			$obj = new TbBibliotecaController();
			$obj->listarSolicitud();
		}

	}

	if($modulo == 'principal'){
		
		if($componente == 'cantidadtiquete'){
			$obj = new TbBibliotecaController();
			$obj->cantidadTiqueteGenerado();
		}

		if($componente == 'cantidadsolicitud'){
			$obj = new TbBibliotecaController();
			$obj->cantidadSolicitud();
		}

		if($componente == 'cantidaddisponible'){
			$obj = new TbBibliotecaController();
			$obj->cantidadLibroDisponible();
		}

		if($componente == 'libromayorsolicitud'){
			$obj = new TbBibliotecaController();
			$obj->libroMayorSolicitud();
		}

		if($componente == 'grafica'){
			$obj = new TbBibliotecaController();
			$obj->primerosMayorSolicitud();
		}

	}

}

/**
* 
*/
class TbBibliotecaController
{

	private $arrayDisponibilidad = array();
	private $arrayTiquetes = array();
	private $arraySolicitud = array();
	private $arrayGraphics = array();

	function listarDisponibilidades(){

		$lista = "	<div class='table-responsive'>
						<table class='table table-striped'>
							<tr>
								<th>Libro</th>
								<th>Estante</th>
								<th>Localizacion</th>							
								<th>CodBarras</th>
								<th>Signatura</th>
								<th>Fecha creación</th>
								<th>Fecha modificación</th>
								<th>Usuario</th>
								<th>Estado</th>
								<th>Fecha prestamo</th>
								<th>Edición</th>
								<th>Categoria</th>
							</tr>
							";
		$detalle = "";
		$obj = new TbBiblioteca();
		$result = $obj->listaDisponibilildad();


		$count = 0;

		while ($arrayDispo = pg_fetch_assoc($result)) {

			$csalon = '';

			$this->arrayDisponibilidad[$count]= $arrayDispo['libro_titulo'];

			$detalle .= "<tr><td>".$arrayDispo['libro_titulo']."</td>";
			$detalle .= "<td>".$arrayDispo['estante_nombre']."</td>";
			$detalle .= "<td>".$arrayDispo['localizacion_localizacion']."</td>";
			$detalle .= "<td>".$arrayDispo['itelibdis_codigobarras']."</td>";
			$detalle .= "<td>".$arrayDispo['itelibdis_signaturatopografica']."</td>";
			$detalle .= "<td>".$arrayDispo['itelibdis_fechacreacion']."</td>";
			$detalle .= "<td>".$arrayDispo['itelibdis_fechamodificacion']."</td>";
			$detalle .= "<td>".$arrayDispo['usuario_nombre']."</td>";
			$detalle .= "<td>".$arrayDispo['estado_nombre']."</td>";
			$detalle .= "<td>".$arrayDispo['itelibdis_fechaprestamo']."</td>";
			$detalle .= "<td>".$arrayDispo['itelibdis_edicion']."</td>";
			$detalle .= "<td>".$arrayDispo['categoria_nombre'].$csalon."</td></tr>";

			$count++;
		}

		$final = "			
						</table>
					</div>";

		$cadenacompleta = $lista.$detalle.$final;

		if($count == 0){
			echo "<div class='alert alert-warning'>
					  	<strong>Warning! </strong>No existen disponiblidades.
					</div>";
		}else{
			echo $cadenacompleta;
		}

	}

	function primerosMayorSolicitud(){

		$obj = new TbBiblioteca();
		$result = $obj->getDosLibrosMayorConsultado();

		$count = 0;

		$nombre1 = "";
		$cant1 = "";
		$nombre2 = "";
		$cant2 = "";

		while ($arrayGrafica = pg_fetch_assoc($result)) {

			if($count == 0){
				$nombre1 = $arrayGrafica['libro_titulo'];
				$cant1 = $arrayGrafica['max'];
			}

			if($count == 1){
				$nombre2 = $arrayGrafica['libro_titulo'];
				$cant2 = $arrayGrafica['max'];
			}

			$count++;
		}

		$cien = $cant1 + $cant2;
		$valor1 = (($cant1*100)/$cien);
		$valor2 = (($cant2*100)/$cien);
		
		if($count != 0){
			echo "<img src='http://chart.apis.google.com/chart?cht=p3&amp;chd=t:".$valor1.",".$valor2."&amp;chs=800x300&amp;chl=".$nombre1."|".$nombre2."' alt='Grafico en Geeks.ms' width='700' height='450' />";
		}/*else{
			echo "<div class='alert alert-warning'>
					  	<strong>Warning! </strong>No hay datos: ".$count.";
					</div>";
		}*/

	}

	function cantidadTiqueteGenerado(){

		$obj = new TbBiblioteca();
		$cantidadtiquete = $obj->getCantidadTiqueteGenerado();

		$tiquete = "<p style='font-size: 20px;'><b>".$cantidadtiquete." tiquetes</b></p>";
		echo $tiquete;

	}
	

	function cantidadSolicitud(){

		$obj = new TbBiblioteca();
		$cantidadsolicitud = $obj->getCantidadSolicitudes();

		$solicitud = "<p style='font-size: 20px;'><b>".$cantidadsolicitud." solicitudes</b></p>";
		echo $solicitud;

	}

	function cantidadLibroDisponible(){

		$obj = new TbBiblioteca();
		$cantidaddisponible = $obj->getCantidadDisponibles();

		$disponible = "<p style='font-size: 20px;'><b>".$cantidaddisponible." libros disponibles</b></p>";
		echo $disponible;

	}

	function libroMayorSolicitud(){

		$obj = new TbBiblioteca();
		$mayorsoli = $obj->getLibroMayorSolicitud();

		$disponible = "<p style='font-size: 20px;'><b>".$mayorsoli." libros disponibles</b></p>";
		echo $disponible;

	}
	

	function listarTiquetes(){

		$lista = "	<div class='table-responsive'>
						<table class='table table-striped'>
							<tr>
								<th>Código tiquete</th>
								<th>Fecha caducidad</th>
								<th>Hora caducidad</th>
								<th>Código estudiante</th>
								<th>Correo estudiante</th>
								<th>Observación</th>
								<th>Libro</th>
								<th>Estante</th>
								<th>Localizacion</th>							
								<th>CodBarras</th>
								<th>Signatura</th>
								<th>Usuario</th>
								<th>Estado disponibilidad</th>
								<th>Edición</th>
								<th>Categoria</th>
								<th>Estado tiquete</th>
							</tr>
							";
		$detalle = "";
		$obj = new TbBiblioteca();
		$result = $obj->listaTiquete();

		$count = 0;

		while ($arrayTiquete = pg_fetch_assoc($result)) {

			$this->arrayTiquetes[$count]= $arrayTiquete['libro_titulo'];

			$detalle .= "<tr><td>".$arrayTiquete['tiquete_codigo']."</td>";
			$detalle .= "<td>".$arrayTiquete['tiquete_fechacaducidad']."</td>";
			$detalle .= "<td>".$arrayTiquete['tiquete_horacaducidad']."</td>";
			$detalle .= "<td>".$arrayTiquete['tiquete_codigoestudiante']."</td>";
			$detalle .= "<td>".$arrayTiquete['tiquete_correoestudiante']."</td>";
			$detalle .= "<td>".$arrayTiquete['tiquete_observacionusuario']."</td>";
			$detalle .= "<td>".$arrayTiquete['libro_titulo']."</td>";
			$detalle .= "<td>".$arrayTiquete['estante_nombre']."</td>";
			$detalle .= "<td>".$arrayTiquete['localizacion_localizacion']."</td>";
			$detalle .= "<td>".$arrayTiquete['itelibdis_codigobarras']."</td>";
			$detalle .= "<td>".$arrayTiquete['itelibdis_signaturatopografica']."</td>";
			$detalle .= "<td>".$arrayTiquete['usuario_nombre']."</td>";
			$detalle .= "<td>".$arrayTiquete['estado_nombre']."</td>";
			$detalle .= "<td>".$arrayTiquete['itelibdis_edicion']."</td>";
			$detalle .= "<td>".$arrayTiquete['categoria_nombre']."</td>";
			$detalle .= "<td>".$arrayTiquete['estadotiquete']."</td></tr>";

			$count++;
		}

		$final = "			
						</table>
					</div>";

		$cadenacompleta = $lista.$detalle.$final;

		if($count == 0){
			echo "<div class='alert alert-warning'>
					  	<strong>Warning! </strong>No existen tiquetes.
					</div>";
		}else{
			echo $cadenacompleta;
		}


	}

	function listarSolicitud(){

		$lista = "	<div class='table-responsive'>
						<table class='table table-striped'>
							<tr>
								<th>Libro</th>
								<th>Mensaje</th>
								<th>Nombre solicitante</th>							
								<th>Correo solicitante</th>							
								<th>Código</th>
								<th>Tipo solicitud</th>
								<th>Fecha solicitud</th>
							</tr>
							";
		$detalle = "";
		$obj = new TbBiblioteca();
		$result = $obj->listaSolicitud();

		$count = 0;

		while ($arraySoli = pg_fetch_assoc($result)) {

			$this->arraySolicitud[$count]= $arraySoli['solicitud_nombrelibro'];

			$detalle .= "<tr><td>".$arraySoli['solicitud_nombrelibro']."</td>";
			$detalle .= "<td>".$arraySoli['solicitud_mensajesolicitud']."</td>";
			$detalle .= "<td>".$arraySoli['solicitud_nombreestudiante']."</td>";
			$detalle .= "<td>".$arraySoli['solicitud_generacorreo']."</td>";
			$detalle .= "<td>".$arraySoli['solicitud_codigoestudiante']."</td>";
			$detalle .= "<td>".$arraySoli['tipsol_descripcion']."</td>";
			$detalle .= "<td>".$arraySoli['solicitud_fechasolicitud']."</td></tr>";

			$count++;
		}

		$final = "			
						</table>
					</div>";

		$cadenacompleta = $lista.$detalle.$final;

		if($count == 0){
			echo "<div class='alert alert-warning'>
					  	<strong>Warning! </strong>No existen disponiblidades.
					</div>";
		}else{
			echo $cadenacompleta;
		}


	}


	
}

?>