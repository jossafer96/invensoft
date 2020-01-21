<?php
include 'C:\xampp\php\PEAR';
include "core/app/model/CategoryData";
    $Category_id=$_POST['Categoria'];
    //$codenext = CategoryData::getNextCode($Category_id);
    //echo "<script type='text/javascript'>alert('$codenext');</script>";
  
    echo $Category_id;
?>