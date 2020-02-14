<?php
$id = $_POST["id"];
$product = ProductData::getById($id);
echo json_encode($product);

?>