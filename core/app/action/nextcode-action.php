<?php
$category_id = $_POST["Categoria"];
$subcategory_id = $_POST["SubCategoria"];
$category = CategoryData::getNextCode($category_id,$subcategory_id);
echo json_encode($category);

?>