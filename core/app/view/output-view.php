<?php
$product = ProductData::getById($_GET['product_id']);
?>

<?php if($product!=null):?>
<div class="row">
	<div class="col-md-8" style="margin: 20px;">
  <div style="font-size:34px;">Alta en inventario</div>
    
    
    


<br><form class="form-horizontal" method="post" action="index.php?view=processoutput" role="form">
<div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Codigo</label>
    <div class="col-lg-10">
      <input type="text" value="<?php echo $product->barcode; ?>" readonly="readonly" class="form-control"  >
    </div>
  </div>
<div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre</label>
    <div class="col-lg-10">
      <input type="text" value="<?php echo $product->name; ?>" readonly="readonly" class="form-control"  >
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Minima en inventario</label>
    <div class="col-lg-10">
      <input type="text" value="<?php echo $product->inventary_min; ?>" readonly="readonly" class="form-control"  >
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Cantidad en inventario</label>
    <div class="col-lg-10">
      <input type="text" value="<?php 
        $q=OperationData::getQ($product->id);
    echo $q; ?>" readonly="readonly" class="form-control"  >
    </div>
  </div>
   <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Descripcion</label>
    <div class="col-lg-10">
      <input type="text" value="<?php echo $product->description; ?>" readonly="readonly" class="form-control" id="inputEmail1" placeholder="Cantidad de productos">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Cantidad</label>
    <div class="col-lg-10">
      <input type="float" required name="q" class="form-control" id="inputEmail1" placeholder="Cantidad de productos">
    </div>
  </div>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <div class="checkbox">
        <label>
        <input type="hidden" name="stock_id" value="<?php echo $product->stock; ?>">
          <input type="hidden" name="product_id" value="<?php echo $_GET['product_id']; ?>">
          <input name="is_oficial" type="hidden" value="1">
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-circle-arrow-up"></i> Baja en inventario</button>
    </div>
  </div>
</form>
	</div>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br>
<?php endif; ?>