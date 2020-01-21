<?php



?>

<?php if((isset($_GET["product_name"]) && $_GET["product_name"]!="") || (isset($_GET["product_code"]) && $_GET["product_code"]!="") ):?>
<?php
$go = $_GET["go"];
$search  ="";
if($go=="code"){ $search=$_GET["product_code"]; }
else if($go=="name"){ $search=$_GET["product_name"]; }
$products = ProductData::getLike($search);
if(count($products)>0){
	?>
<h3>Resultados de la Busqueda</h3>
<div class="box box-primary">
<table class="table table-bordered table-hover">
	<thead>
		<th>Codigo</th>
		<th>Nombre</th>
		<th>Unidad Asignada</th>
		<th>Responsable</th>
		<th>Asignado a</th>
		<th>En inventario</th>
		<th>Cantidad</th>
	</thead>
	<?php
$products_in_cero=0;
	 foreach($products as $product):
$q= OperationData::getQByStock($product->id,StockData::getPrincipal()->id);
	?>
	<?php 
	if($q>0):
		?>
		
	<tr class="<?php if($q<=$product->inventary_min){ echo "danger"; }?>">
		<td style="width:80px;"><?php echo $product->barcode; ?></td>
		<td><?php echo $product->name; ?></td>
		<td><?php echo $product->name_unit; ?></td>
		<td><?php echo $product->user_responsable; ?></td>
		<td><b><?php echo $product->asing; ?></b></td>
		<td>
			<?php echo $q; ?>
		</td>
		<td style="width:250px;"><form method="post" action="index.php?view=addasing">
		<input type="hidden" name="product_id" value="<?php echo $product->id; ?>">

<div class="input-group">
		<input type="" class="form-control" required name="q" placeholder="Cantidad ...">
      <span class="input-group-btn">
		<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> Asignar</button>
      </span>
    </div>


		</form></td>
	</tr>

<?php else:$products_in_cero++;
?>
<?php  endif; ?>
	<?php endforeach;?>
</table>
</div>
<?php if($products_in_cero>0){ echo "<p class='alert alert-warning'>Se omitieron <b>$products_in_cero productos</b> que no tienen existencias en el inventario. <a href='index.php?view=inventary&stock=".StockData::getPrincipal()->id."'>Ir al Inventario</a></p>"; }?>

	<?php
}else{
	echo "<br><p class='alert alert-danger'>No se encontro el producto</p>";
}
?>
<hr><br>
<?php else:
?>
<?php endif; ?>