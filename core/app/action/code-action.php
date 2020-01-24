<?php
$Subcategory_id = $_POST["SubCategoria"];
$category = CategoryData::getCode($Subcategory_id);
echo json_encode($category);

?>