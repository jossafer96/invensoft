<?php
$category_id = $_POST["Categoria"];
$category = CategoryData::getAllSub($category_id);
echo json_encode($category);

?>