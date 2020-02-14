<?php

if(count($_POST)>0){
	$user = new CategoryData();
	$user->name = $_POST["name"];
	$user->abreviation = $_POST["abreviation"];
	$user->description = $_POST["description"];
	$user->add();
	//print_r($user);
print "<script>window.location='index.php?view=categories';</script>";


}

?>