<?php

$subcategory = SubCategoryData::getByIds($_GET["id"],$_GET["id2"]);
$products = ProductData::getAllBySubCategoryId($subcategory->id);
foreach ($products as $product) {
	$product->del_subcategory();
}
//print_r($category);
$subcategory->del();

Core::redir("./index.php?view=subcategories");


?>