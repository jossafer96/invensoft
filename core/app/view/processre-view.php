<?php
if(isset($_SESSION["reabastecer"])){
	$cart = $_SESSION["reabastecer"];
	if(count($cart)>0){

$process = true;

//////////////////////////////////
		if($process==true){
			$sell = new SellData();
			$sell->user_id = $_SESSION["user_id"];
			$sell->p_id = $_POST["p_id"];
			$sell->d_id = $_POST["d_id"];
			$sell->total = $_POST["money"];
			$sell->stock_to_id = $_POST["stock_id"];
			$sell->person_id=$_POST["client_id"]!=""?$_POST["client_id"]:"NULL";

			$s = $sell->add_re();


		foreach($cart as  $c){

			$operation_type = 1;
			if($_POST["d_id"]==2){ $operation_type= 3; // 3.- entrada-pendiente 
			}

			$product = ProductData::getById($c["product_id"]);

			$op = new OperationData();
			$user_id = $_SESSION["user_id"];
			$description_operation_start= 'Reabastecimiento de equipo '.$product->name;
			$op->description_operation = $description_operation_start;
			$op->user=$user_id;
			$price=$_POST["money"];
			$quantity=$c["q"];
			$op->price_in = $price;
			$op->stock_id = $_POST["stock_id"];
			 $op->product_id = $c["product_id"] ;
			 $op->operation_type_id=$operation_type; // 1 - entrada
			 $op->sell_id=$s[1];
			 $op->q= $c["q"];

			$add = $op->add();			 		

		}
//////////////////


			unset($_SESSION["reabastecer"]);
			setcookie("selled","selled");
////////////////////
print "<script>window.location='index.php?view=onere&id=$s[1]';</script>";
		}
	}
}



?>