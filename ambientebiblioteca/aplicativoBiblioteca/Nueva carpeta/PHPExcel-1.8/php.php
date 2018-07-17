<?php
 /* Ejemplo 1 generando excel desde mysql con PHP
    @Autor: Carlos Hernan Aguilar Hurtado
 */
 

 $conexion = mysqli_connect ("localhost",  "root",  "",  "nueva");
 $sql = "SELECT * FROM tb_prueba";
 $resultado = mysqli_query ($conexion,  $sql) or die (mysqli_error ($conexion));
 $registros = mysqli_num_rows ($resultado);

 if ($registros > 0) {
   require_once 'Classes/PHPExcel.php';
   $objPHPExcel = new PHPExcel();
   
   //Informacion del excel
   $objPHPExcel->
    getProperties()
        ->setCreator("ingenieroweb.com.co")
        ->setLastModifiedBy("ingenieroweb.com.co")
        ->setTitle("Exportar excel desde mysql")
        ->setSubject("Ejemplo 1")
        ->setDescription("Documento generado con PHPExcel")
        ->setKeywords("ingenieroweb.com.co  con  phpexcel")
        ->setCategory("ciudades");    

   $i = 1;    
   while ($registro = mysqli_fetch_object ($resultado)) {
       
      $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i,  $registro->name);
 
      $i++;
      
   }
}
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="ejemplo1.csv"');
header('Cache-Control: max-age=0');

$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
$objWriter->save('/tmp/file.xlsx');
exit;
mysql_close ();
?>