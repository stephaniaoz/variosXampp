<?php

$arreglo = array(
	array('a','b','c'),
	array('d','e','f'),
	array('f','g','h'));
	
$fp = fopen('archivo.csv','w');

foreach($arreglo as $campos){
	fputcsv($fp,  $campos);	
}

fclose($fp);


?>