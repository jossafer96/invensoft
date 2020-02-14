<?php

if(count($_POST)>0){
	$user = PasswordData::getById($_POST["id"]);
	$user->id_type = $_POST["type_id"];
	$user->account = $_POST["account"];
	$user->password = $_POST["password"];
	$user->product_id = $_POST["product_id"];
	
	$user->update();


print "<script>window.location='index.php?view=password';</script>";


}


?>