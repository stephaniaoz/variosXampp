<?php

$conexion = mysqli_connect("localhost","root","","nueva") or die("No es posible la conexion");
if (mysqli_connect_errno()) {
   printf("La conexión con el servidor de base de datos falló: %s\n",  mysqli_connect_error());
   exit();
}


$consulta = "SELECT concat(paterno,' ',  materno,  ' ' ,  nombre) AS alumno,  fechanac,  sexo,  carrera FROM alumno ";
$consulta .= " INNER JOIN carrera ON alumno.idcarrera = carrera.idcarrera ORDER BY carrera,  nombre";
 
$resultado = $conexion->query($consulta);



?>