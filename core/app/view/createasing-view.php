<?php
//funcion que se encarga de obtener los datos del formulario de new product
require 'plugins/PHPexcel/PHPExcel.php';
require 'plugins/PHPexcel/PHPExcel/IOFactory.php';

$product = ProductData::getById($_GET["id"]);
$person = personData::getById($product->asing);
    $asing = $person->name." ".$person->lastname;
    $asing1 = $person->name."".$person->lastname;
$unit = unitsData::getById($person->program);
$user = UserData::getById($product->user_id);
$accounts = PasswordData::getByProductId($_GET["id"]);


	// Creamos un objeto PHPExcel
	$objPHPExcel = new PHPExcel();
	$objReader = PHPExcel_IOFactory::createReader('Excel2007');
  $objPHPExcel = $objReader->load('plugins/PHPexcel/plantillas/PlantillaEntrega.xlsx');
  
  // Indicamos que se pare en la hoja uno del libro
  $objPHPExcel->setActiveSheetIndex(0);
  
  //Modificamos los valoresde las celdas
  $objPHPExcel->getActiveSheet()->SetCellValue('D4', $asing);
  $objPHPExcel->getActiveSheet()->SetCellValue('F4', $unit->name_unit);
  $objPHPExcel->getActiveSheet()->SetCellValue('D5', $user->name." ".$user->lastname);
  $objPHPExcel->getActiveSheet()->SetCellValue('F5', date('d-m-Y'));
  $objPHPExcel->getActiveSheet()->SetCellValue('D22', $product->serial);
  $objPHPExcel->getActiveSheet()->SetCellValue('B28', $product->description);
  foreach($accounts as $account):
  if ($account->name_type=='Google') {
    $objPHPExcel->getActiveSheet()->SetCellValue('D7', $account->description);
    $objPHPExcel->getActiveSheet()->SetCellValue('E7', $account->password);
  }
  if ($account->name_type=='Desbloqueo') {
    $objPHPExcel->getActiveSheet()->SetCellValue('D16', $account->password);
  }
endforeach;
  // incluir gráfico
	
	//Guardamos los cambios
 
  // We'll be outputting an excel file

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  
	//$objWriter->save("Archivo_salida.xlsx");
  
  $objWriter->save("docs/Asignaciones/Asignacion_".$asing1."_".$product->barcode.".xlsx");



//print_r($op);
//print "<script>document.execCommand('SaveAs',true,'docs/Asignaciones/Asignacion_".$product->name.".xlsx');</script>";
print "<script>window.location='index.php?view=asing';</script>";





?>