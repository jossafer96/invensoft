<?php
// funcion que se encarga de obtener los datos del formulario de new product
if(count($_POST)>0){
  $product = new ProductData();
  $product->barcode = $_POST["barcode"];
  $product->name = $_POST["name"];
  
  $category_id="NULL";
  if($_POST["category_id"]!=""){ $category_id=$_POST["category_id"];}
  $product->category_id=$category_id;

  $subcategory_id="NULL";
  if($_POST["subcategory_id"]!=""){ $subcategory_id=$_POST["subcategory_id"];}
  $product->subcategory_id=$subcategory_id;
 
  $product->description = $_POST["description"];
  $product->price_in = $_POST["price_in"];
  $product->state = $_POST["state"];
  $product->funding = $_POST["funding"];
  $product->stock = $_POST["stock"];
  $product->unit_id = $_POST["unit"];
  $product->asign = $_POST["asing"];
  $date_expire="\"\"";
  if($_POST["date_expire"]!=""){ $date_expire=$_POST["date_expire"];}
  $product->date_expire=$date_expire;

  $date_warranty="\"\"";
  if($_POST["date_warranty"]!=""){ $date_warranty=$_POST["date_warranty"];}
  $product->date_warranty=$date_warranty;
  
  $product->user_id = $_SESSION["user_id"];
  
  $inventary_min="\"\"";
  if($_POST["inventary_min"]!=""){ $inventary_min=$_POST["inventary_min"];}
  $product->inventary_min=$inventary_min;

  $inventary_in="\"\"";
  if($_POST["inventary_in"]!=""){ $inventary_in=$_POST["inventary_in"];}
  $product->inventary_in=$inventary_in;
  
  
  
  


  if(isset($_FILES["image"])){
    $image = new Upload($_FILES["image"]);
    if($image->uploaded){
      $image->Process("storage/products/");
      if($image->processed){
        $product->image = $image->file_dst_name;
        //$prod = $product->add_with_image();
      }
    }else{

  $prod= $product->add();
    }
  }
  else{
    
 $prod= $product->add();

  }
  //print_r ($prod);
  //print_r ($product);



if($_POST["inventary_in"]!="" || $_POST["inventary_in"]!="0"){
 $op = new OperationData();
 $op->product_id = $prod[1] ;
 $op->stock_id = StockData::getPrincipal()->id;
 $op->operation_type_id=OperationTypeData::getByName("entrada")->id;
 $op->price_in =$_POST["price_in"];
 $op->q= $_POST["inventary_in"];
 $op->sell_id="NULL";
$op->is_oficial=1;
//$op->add();
}

print "<script>window.location='index.php?view=products';</script>";


}


?>