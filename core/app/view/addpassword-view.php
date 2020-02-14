<?php

if(count($_POST)>0){
	$user = new PasswordData();
	$user->id_type = $_POST["type_id"];
	$user->description = $_POST["account"];
	$user->password = $_POST["password"];
	$user->product_id = $_POST["product_id"];
	$user->add();
	//print_r($user);
print "<script>window.location='index.php?view=password';</script>";


}

?>