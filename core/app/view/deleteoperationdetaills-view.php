<?php



$operation = OperationData::getById($_GET["opid"]);
$operation->del();

print "<script>window.location='index.php?view=products';</script>";

?>