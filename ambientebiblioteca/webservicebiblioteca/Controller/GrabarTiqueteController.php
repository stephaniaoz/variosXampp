<?php
include_once("C:xampp\htdocs\webservicebiblioteca\db\database_utilities.php");

	$palabraclave = "";

	$datos = array();

	if($_REQUEST){
		$codigodisponibilidad = $_REQUEST['itelibdis_codigo'];
		$correoestudiante = $_REQUEST['correoestudiante'];
		$libro_codigo = $_REQUEST['libro_codigo'];
		$codigoestudiante = $_REQUEST['codigoestudiante'];
		$observacionestudiante = $_REQUEST['observacionestudiante'];
	}


	if($codigodisponibilidad != "" || !is_null($codigodisponibilidad)){

		if(getEstadoDisponibilidad($codigodisponibilidad) != "DISPONIBLE"){
			die("El libro no está disponible en este item ya que su estado es: ".getEstadoDisponibilidad($codigodisponibilidad));
		}else{
			$codigomaximo = getCodigoTiquete();
		
			$query = "	INSERT INTO tb_tiquete(
					            tiquete_codigo, tiquete_fechacreacion, tiquete_fechacaducidad, 
					            tiquete_horacaducidad, itelibdis_codigo, tiquete_codigoestudiante, tiquete_correoestudiante, tiquete_observacionusuario, estado_codigo)
					    VALUES (".$codigomaximo.", current_date, current_date, 
					            '24:00:00'::time, ".$codigodisponibilidad.", '".$codigoestudiante."' ,'".$correoestudiante."', '".$observacionestudiante."', 10); ";

			$result = @pg_query($query) or die ('La consulta fallo: ' . pg_last_error());
			$errorquery = @pg_last_error();

			if($errorquery){
				$afectadas = "La consulta falló cod 1";
			}else{

				$query_lb = " UPDATE tb_itemlibrodisponibilidad SET estado_codigo = 8 WHERE itelibdis_codigo = ".$codigodisponibilidad." ";

				$result = @pg_query($query_lb) or die ('La consulta fallo: ' . pg_last_error());
				$errorquery = @pg_last_error();

				if($errorquery){
					$afectadas = "La consulta falló cod 2";
				}else{
					$afectadas = "Se guardó exitosamente, filas afectadas ".pg_affected_rows($result);
					$correcto = true;					
				}

				$afectadas = "Se guardó exitosamente, filas afectadas ".pg_affected_rows($result);
				$correcto = true;	
			}


			/*while ($row = pg_fetch_array($result, null, PGSQL_ASSOC)) {
				$datos[] = $row;
			}*/
		}

	}


	function getCodigoTiquete(){

		$query = "	SELECT case when max(t.tiquete_codigo) = 0 or max(t.tiquete_codigo) is null then 1 else max(t.tiquete_codigo)+1 end as tiquete_codigo
					FROM tb_tiquete t ";

			$result = pg_query($query) or die ('La consulta fallo: ' . pg_last_error());

			$array = pg_fetch_assoc($result);			
			$maximo = $array['tiquete_codigo'];

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

	echo "su codigo de tiquete es: ".$codigomaximo.", habilitado hasta las 12:00 pm.";//json_encode($datos);


?>