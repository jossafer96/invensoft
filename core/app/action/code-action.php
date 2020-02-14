<?php
$category_id = $_POST["Categoria"];
$Subcategory_id = $_POST["SubCategoria"];
$category = CategoryData::getCode($Subcategory_id,$category_id);
echo json_encode($category);

?>