<?php
include_once("C:xampp\htdocs\webservicebiblioteca\db\database_utilities.php");

	$palabraclave = "";

	if($_REQUEST){
		$palabraclave = " WHERE libro_titulo ILIKE '%";
		$palabraclave = $palabraclave.$_REQUEST['palabraclave']."%'";
	}
	
	$datos = array();

	$query = "	SELECT * 
				FROM tb_libro l
				".$palabraclave." 
				ORDER BY l.libro_titulo ";

	$result = pg_query($query) or die ('La consulta fallo: ' . pg_last_error());
	
	$cont = pg_num_rows($result);

	while ($row = pg_fetch_array($result, null, PGSQL_ASSOC)) {
		$datos[] = $row;
	}

	echo json_encode($datos);	

?>