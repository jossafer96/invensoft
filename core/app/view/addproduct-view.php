<?php
//funcion que se encarga de obtener los datos del formulario de new product
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
  $product->brand = $_POST["brand"];
  $product->model = $_POST["model"];
  $product->serial = $_POST["serial"];

  if(isset($_POST["description"])){ 
    $description=$_POST["description"];
  }
  if (isset($_POST["description_1"])) {
    $description=$_POST["description_1"];
  };

  $product->description = $description;
  $product->comment = $_POST["comment"];
  $product->price_in = $_POST["price_in"];
  $product->state = $_POST["state"];
  $product->funding = $_POST["funding"];
  $product->stock = $_POST["stock"];
  $product->unit_id = 'NULL';
  $product->user_responsable = $_POST["asing"];
  $date_expire="\"\"";
  if(isset($_POST["date_expire"])){ $date_expire=$_POST["date_expire"];}
  $product->date_expire=$date_expire;

  $date_warranty="\"\"";
  if(isset($_POST["date_warranty"])){ $date_warranty=$_POST["date_warranty"];}
  $product->date_warranty=$date_warranty;
  
  $product->user_id = $_SESSION["user_id"];
  
  $inventary_min="\"\"";
  if(isset($_POST["inventary_min"])){ $inventary_min=$_POST["inventary_min"];}
  $product->inventary_min=$inventary_min;
  $is_unique=1;
  $inventary_in="\"\"";
  if(isset($_POST["inventary_in"])){ 
    $inventary_in=$_POST["inventary_in"];
    $is_unique=0;
  }
  $product->is_unique=$is_unique;
  $product->inventary_in=$inventary_in;
  
  
  
  


  if($_FILES["file"]['name']!=""){
    
    $file = new Upload();
    $file_url = $file->File($_FILES["file"],$_POST["barcode"]);
    $product->file_url=$file_url;
    //echo '<pre>';
    //print_r($file_url);
    //echo '</pre>';
  }
  else{
    
    $product->file_url="NULL";

  }
  //print_r($_POST["description"]);
  //print_r($_POST["description_1"]);
  //print_r ($description);
  //echo '<pre>';
 //print_r ($product);
  //echo '</pre>';
  //print_r ($prod);
  //$product->add();
  $prod= $product->add();



if($_POST["name"]!="" || $_POST["barcode"]!=""){
    $op = new OperationData();
    $op->product_id = $prod[1] ;
    $op->user = $_SESSION["user_id"];
    $op->stock_id = $_POST["stock"];
   
    if(isset($_POST["inventary_in"])){ 
      $in=$_POST["inventary_in"];
    }else{
      $in=1;
    };
    $op->description_operation = $in." Nuevo(s) producto en inventario";
    $op->q = $in;
    $op->price_in =$_POST["price_in"];
    $op->operation_type_id=OperationTypeData::getByName("Nuevo producto")->id;
    $op->sell_id="NULL";
    $op->is_oficial=1;
  $op->add();
}
//print_r($op);

print "<script>window.location='index.php?view=products';</script>";


}


?>