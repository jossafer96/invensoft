<?php

if(count($_POST)>0){
	$user = new SubCategoryData();
	$user->id = $_POST["id"];
	$user->name = $_POST["name"];
	$user->category_id = $_POST["category_id"];
	$user->description = $_POST["description"];
	$user->add();
	//print_r($user);
print "<script>window.location='index.php?view=subcategories';</script>";


}

?>