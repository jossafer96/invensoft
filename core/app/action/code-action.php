<?php
$Subcategory_id = $_POST["SubCategoria"];
$category = CategoryData::getAllSub($category_id);
echo json_encode($category);

?>