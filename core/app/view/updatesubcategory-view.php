<?php

if(count($_POST)>0){
	$user = SubCategoryData::getById($_POST["user_id"]);
	$user->codigo = $_POST["id"];
	$user->id = $_POST["user_id"];
	$user->id_category = $_POST["category_id"];
	$user->name = $_POST["name"];
	$user->category_id = $_POST["category_id"];
	$user->description = $_POST["description"];
	$user->update();
	//print_r($user);
print "<script>window.location='index.php?view=subcategories';</script>";


}


?>