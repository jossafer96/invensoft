<?php

if(count($_POST)>0){
	$product = ProductData::getById($_POST["product_id"]);

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
  	$is_active=1;
  //if(isset($_POST["is_active"])){ $is_active=1;}

  $product->is_active=$is_active;
  

	
	$product->update();
	//print_r($product);

	if(isset($_FILES["image"])){
		$image = new Upload($_FILES["image"]);
		if($image->uploaded){
			$image->Process("storage/products/");
			if($image->processed){
				$product->image = $image->file_dst_name;
				$product->update_image();
			}
		}
	}

	setcookie("prdupd","true");
	print "<script>window.location='index.php?view=editproduct&id=$_POST[product_id]';</script>";


}


?>