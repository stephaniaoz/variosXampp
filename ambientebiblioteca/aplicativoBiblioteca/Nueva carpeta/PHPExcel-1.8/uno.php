<?php

//conection: 
$link = mysqli_connect("localhost","root","","nueva") or die("No es posible la conexion");
 
//conection:
 
$Name = 'Reporte_UltimaCuotaPaga.csv';
$FileName = "./$Name";
$Datos = 'NOMBRE;APELLIDO;TELEFONO;CIUDAD';
$Datos .= "\r\n";
 
//Descarga el archivo desde el navegador
header('Expires: 0');
header('Cache-control: private');
header('Content-Type: application/x-octet-stream'); // Archivo de Excel
header('Cache-Control: must-revalidate,  post-check=0,  pre-check=0');
header('Content-Description: File Transfer');
header('Last-Modified: '.date('D,  d M Y H:i:s'));
header('Content-Disposition: attachment; filename="'.$Name.'"');
header("Content-Transfer-Encoding: binary");
 
/**1.  consultar sap_maestro_cartera_v3 **/
$sSQL = "SELECT 
         uno,
         dos,
         tres                 
 FROM tb_prueba
       ";
$RsSql = $link->mysqli_query($sSQL);
 
while($oRow = mysql_fecth_object($RsSql) ){
    $Datos .= "$oRow->uno;$oRow->dos;$oRow->tres;   ";
    $Datos .= "\r\n"; 
 
}#end while
 
echo $Datos;

?>