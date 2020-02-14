<?php

if(count($_POST)>0){
	$user = new unitsData();
	$user->name_unit = $_POST["name"];
	$user->description = $_POST["description"];
	$user->add();
	//print_r($user);
print "<script>window.location='index.php?view=programs';</script>";


}

?>