<?php

$unit = unitsData::getById($_GET["id"]);
$products = ProductData::getAllByUnitId($unit->unit_id);
foreach ($products as $product) {
	$product->del_unit();
}

$unit->del();
Core::redir("./index.php?view=programs");


?>