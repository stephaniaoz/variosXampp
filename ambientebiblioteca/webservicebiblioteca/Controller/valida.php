<?php
include_once("C:\wamp64\www\webservicebiblioteca\db\database_utilities.php");


$usu = $_REQUEST['usu'];
$pass = $_REQUEST['pass'];


$count = 0;
/*
$query  = " SELECT * 
			FROM tb_alumno
			WHERE alumno_usuario = '".$usu."' and alumno_password = '".$pass."' "; */

$query  = " SELECT * 
			FROM tb_alumno ";

$result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

$datos = array();

while ($arrayUsuContact = pg_fetch_assoc($result)) {
	$datos[$count]['alumno_usuario'] = $arrayUsuContact['alumno_usuario'];
	$datos[$count]['alumno_password'] = $arrayUsuContact['alumno_password'];
	$count++;
}	

//$cnx = new PDO("mysql:host=localhost:8080;dbname=bd_valida","root","");
/*
$res = $cnx->query("select * from tb_alumno where codAlu = '$usu' and pasUsu ='$pas'");

$datos = array();

foreach ($res as $row) {
	$datos[] = $row;
}

echo json_encode($datos);
*/
echo json_encode($datos);
//echo 200;

?>