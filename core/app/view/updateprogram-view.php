<?php

if(count($_POST)>0){
	$user = unitsData::getById($_POST["user_id"]);
	$user->name_unit = $_POST["name"];
	$user->description = $_POST["description"];
	
	$user->update();


print "<script>window.location='index.php?view=programs';</script>";


}


?>