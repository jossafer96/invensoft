<?php

if(count($_POST)>0){
	$user = CategoryData::getById($_POST["user_id"]);
	$user->name = $_POST["name"];
	$user->abreviation = $_POST["abreviation"];
	$user->description = $_POST["description"];
	$user->update();
print "<script>window.location='index.php?view=categories';</script>";


}


?>