<?php
date_default_timezone_set("America/Mexico_City");
if(isset($_SESSION["cart"])){
	$cart = $_SESSION["cart"];
	if(count($cart)>0){
/// antes de proceder con lo que sigue vamos a verificar que:
		// haya existencia de productos
		// si se va a facturar la cantidad a facturr debe ser menor o igual al producto facturado en inventario
		$num_succ = 0;
		$process=false;
		$errors = array();
		foreach($cart as $c){

			///
			$q = OperationData::getQByStock($c["product_id"],StockData::getPrincipal()->id);
			if($c["q"]<=$q){
				if(isset($_POST["is_oficial"])){
				$qyf =OperationData::getQByStock($c["product_id"],StockData::getPrincipal()->id); /// son los productos que puedo facturar
				if($c["q"]<=$qyf){
					$num_succ++;
				}else{
				$error = array("product_id"=>$c["product_id"],"message"=>"No hay suficiente cantidad de producto para facturar en inventario.");					
				$errors[count($errors)] = $error;
				}
				}else{
					// si llegue hasta aqui y no voy a facturar, entonces continuo ...
					$num_succ++;
				}
			}else{
				$error = array("product_id"=>$c["product_id"],"message"=>"No hay suficiente cantidad de producto en inventario.");
				$errors[count($errors)] = $error;
			}

		}

if($num_succ==count($cart)){
	$process = true;
}

if($process==false){
$_SESSION["errors"] = $errors;
	?>	
<script>
	window.location="index.php?view=asing";
</script>
<?php
}





//////////////////////////////////
		if($process==true){
		foreach($cart as  $c){
			// asignar equipo y cambiarlo en la Base de Datos
			$op1 = new ProductData();
			$resposable=$_POST["responsable_id"];
			$op1->id = $c["product_id"] ;
			$op1->user_responsable= $resposable;
			$s = $op1->update_user_responsable();

			//crea registro de la asignacion
			
			
			if (count(AsingsData::getAllById($c["product_id"]))>0) {
				$productUlt = AsingsData::getUlt($c["product_id"]);
				$asing = new AsingsData();
				$asing->is_active=0;
				$asing->id=$productUlt->id;
				$asing->user_id=$productUlt->user_id;
				$asing->product_id=$productUlt->product_id;
				$asing->finish_at="NOW()";
				$update= $asing->update();
				$asing1 = new AsingsData();
				$asing1->description="";
				$asing1->product_id=$c["product_id"];
				$asing1->created_at="NOW()";
				$asing1->finish_at="NULL";
				$asing1->is_active=1;
				$asing1->user_id=$_POST["responsable_id"];
				$new= $asing1->add();
				//print_r($new);
			};
			if (count(AsingsData::getAllById($c["product_id"]))==0) {
				$asing = new AsingsData();
				$asing->description="";
				$asing->product_id=$c["product_id"];
				$asing->created_at="NOW()";
				$asing->finish_at="NULL";
				$asing->is_active=1;
				$asing->user_id=$_POST["responsable_id"];
				$new= $asing->add();
				//print_r($new);
			};


			//Crear un registro de la operacion realizada.
			$description_operation_start= 'Asignacion de equipo a '.$_POST["responsable_name"];
			$product = ProductData::getById($c["product_id"]);
			$op = new OperationData();
			$op->price_in = $product->price_in;
			$op->product_id = $c["product_id"] ;
			$op->operation_type_id='7';
			$op->description_operation=$description_operation_start;
			$op->user=$_SESSION["user_id"];
			$op->stock_id = StockData::getPrincipal()->id;
			$op->q= $c["q"];
			$op->sell_id='null';
			//print_r($op);
			$add = $op->add();
			
	
			
							 		




$qx = OperationData::getQByStock($product->id,StockData::getPrincipal()->id);
$subject="";
$message="";
$last = true;
if($qx==0){
			$subject = "[$product->name]".' No hay existencias';
			$message = "Hola, el producto <b>$product->name</b> no tiene existencias en el inventario";
			$last=false;
		}

if($qx<=$product->inventary_min/2 && $last){
	$subject = "[$product->name]".' Muy pocas existencias';
	$message = "Hola, el producto <b>$product->name</b> tiene muy pocas existencias en el inventario";
			$last=false;

}
if($qx<=$product->inventary_min && $last){
	$subject = "[$product->name]".' Pocas existencias';
	$message = "Hola, el producto <b>$product->name</b> tiene pocas existencias en el inventario";
			$last=false;
}
//////////////////
		if($subject!=""&&$message!=""){
				$m = new MailData();
				$m->open();
			    $m->mail->Subject = $subject;
			    $m->message = "<p>$message</p>";
			    $m->mail->IsHTML(true);
			    $m->send();
			}
//////////////////







////////////

		}
			unset($_SESSION["cart"]);
			setcookie("selled","selled");////
			////////////////
print "<script>window.location='index.php?view=oneasing&id=".$c["product_id"]."';</script>";
		}
	}
}



?>