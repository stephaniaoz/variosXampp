<?php
include_once("C:xampp\htdocs\webservicebiblioteca\db\database_utilities.php");

	$libro_codigo = "";

	if($_REQUEST){
		$libro_codigo = $_REQUEST['librocodigo'];
	}
	
	$datos = array();

	if($libro_codigo != ""){

		$query = "	SELECT lb.libro_titulo, es.estante_nombre, l.localizacion_localizacion, e.estado_nombre, c.categoria_nombre, id.* 
					FROM tb_itemlibrodisponibilidad id
					JOIN tb_libro lb ON lb.libro_codigo = id.libro_codigo
					JOIN tb_estante es ON es.estante_codigo = id.estante_codigo
					JOIN tb_estado e ON e.estado_codigo = id.estado_codigo
					JOIN tb_categoria c ON c.categoria_codigo = id.categoria_codigo
					JOIN tb_usuario u ON u.usuario_codigo = id.usuario_codigo
					JOIN tb_localizacion l ON l.localizacion_codigo = es.localizacion_codigo
					WHERE id.libro_codigo = ".$libro_codigo." ";

			$result = pg_query($query) or die ('La consulta fallo: ' . pg_last_error());
			
			$cont = pg_num_rows($result);

			while ($row = pg_fetch_array($result, null, PGSQL_ASSOC)) {
				$datos[] = $row;
				//echo "<pre>";
				//print_r($row);
			}

	}	

	echo json_encode($datos);	

?>