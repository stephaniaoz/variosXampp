<?php
include_once("C:xampp\htdocs\webservicebiblioteca\db\database_utilities.php");

	$palabraclave = "";

	$datos = array();

	$afectadas = "";

	$codigodisponibilidad = "";
	$correoestudiante = "";
	$codigoestudiante = "";
	$mensajeestudiante = "";
	$nombreestudiante = "";
	$nombrelibro = "";

	if($_REQUEST){
		$codigodisponibilidad = $_REQUEST['itelibdis_codigo'];
		$correoestudiante = $_REQUEST['correoestudiante'];
		$codigoestudiante = $_REQUEST['codigoestudiante'];
		$mensajeestudiante = $_REQUEST['mensajeestudiante'];
		$nombreestudiante = $_REQUEST['nombreestudiante'];
		$nombrelibro = $_REQUEST['nombrelibro'];
	}


	if($codigodisponibilidad != "" || !is_null($codigodisponibilidad)){

			$tiposolicitud = 1; //libro no disponible
			$codigomaximo = getCodigoSolicitud();
		
			$query = "	INSERT INTO tb_solicitud(
					            solicitud_codigo, solicitud_nombrelibro, solicitud_mensajesolicitud, 
					            solicitud_nombreestudiante, solicitud_codigoestudiante, tipsol_codigo, 
					            solicitud_generacorreo, itelibdis_codigo, solicitud_correosolicitante, solicitud_fechasolicitud)
					    VALUES (".$codigomaximo.", '".$nombrelibro."', '".$mensajeestudiante."', 
					            '".$nombreestudiante."', '".$codigoestudiante."', ".$tiposolicitud.", 
					            'NO', ".$codigodisponibilidad.", '".$correoestudiante."', current_date); ";

			$result = @pg_query($query) or die ('La consulta fallo: ' . pg_last_error());
			$errorquery = @pg_last_error();

			if($errorquery){
				$afectadas = "La consulta falló cod 1";
			}else{

				$afectadas = "Se guardó exitosamente, filas afectadas ".pg_affected_rows($result);
				$correcto = true;	
			}


			/*while ($row = pg_fetch_array($result, null, PGSQL_ASSOC)) {
				$datos[] = $row;
			}*/

	}else{

		$tiposolicitud = 2; //libro no existe
		$codigomaximo = getCodigoSolicitud();
	
		$query = "	INSERT INTO tb_solicitud(
				            solicitud_codigo, solicitud_nombrelibro, solicitud_mensajesolicitud, 
				            solicitud_nombreestudiante, solicitud_codigoestudiante, tipsol_codigo, 
				            solicitud_generacorreo, itelibdis_codigo, solicitud_correosolicitante)
				    VALUES (".$codigomaximo.", '".$nombrelibro."', '".$mensajeestudiante."', 
				            '".$nombreestudiante."', '".$codigoestudiante."', ".$tiposolicitud.", 
				            'NO', null, '".$correoestudiante."'); ";

		$result = @pg_query($query) or die ('La consulta fallo: ' . pg_last_error());
		$errorquery = @pg_last_error();

		if($errorquery){
			$afectadas = "La consulta falló cod 2";
		}else{

			$afectadas = "Se guardó exitosamente, filas afectadas ".pg_affected_rows($result);
			$correcto = true;	
		}		

	}


	function getCodigoSolicitud(){

		$query = "	SELECT case when max(s.solicitud_codigo) = 0 or max(s.solicitud_codigo) is null then 1 else max(s.solicitud_codigo)+1 end as solicitud_codigo
					FROM tb_solicitud s ";

			$result = pg_query($query) or die ('La consulta fallo: ' . pg_last_error());

			$array = pg_fetch_assoc($result);			
			$maximo = $array['solicitud_codigo'];

			return $maximo;
	}

	function getEstadoDisponibilidad($codigo_disponibilidad){

		$query = "	SELECT e.estado_nombre
					FROM tb_itemlibrodisponibilidad i
					JOIN tb_estado e ON e.estado_codigo = i.estado_codigo
					WHERE itelibdis_codigo = ".$codigo_disponibilidad." ";

			$result = pg_query($query) or die ('La consulta fallo: ' . pg_last_error());

			$array = pg_fetch_assoc($result);			
			$estado = $array['estado_nombre'];

			return $estado;	

	}

	echo $afectadas;


?>