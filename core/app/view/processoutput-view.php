<?php

if(count($_POST)>0){

 $op = new OperationData();
 $op->product_id = $_POST["product_id"] ;
 $op->user = $_SESSION["user_id"];
 $op->description_operation = $_POST["q"]." Productos dados de baja del inventario";
 $op->operation_type_id=OperationTypeData::getByName("Salida")->id;
if(OperationTypeData::getByName("Salida")->name=="Salida"){
	$op->sell_id="NULL";
}
 $op->q= $_POST["q"];

if($_POST["is_oficial"]=="1"){
	$op->is_oficial = 1;
}else{	
	$op->is_oficial = 0;
}
$op->stock_id =$_POST["stock_id"];
$op->price_in ='NULL';
print_r($op);
//$add = $op->add();
if($op->is_oficial==1){
 //print "<script>window.location='index.php?view=history&product_id=$_POST[product_id]&stock=$_POST[stock_id]';</script>";
}else{
  //[disabled] print "<script>window.location='index.php?view=historyn&product_id=$_POST[product_id]';</script>";

}

}

?>