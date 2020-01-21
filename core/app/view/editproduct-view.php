<section class="content">
<?php
$product = ProductData::getById($_GET["id"]);
$categories = CategoryData::getAll();

if($product!=null):
?>
<div class="row">
	<div class="col-md-12">
	<h1><?php echo $product->name ?> <small>Editar Producto</small></h1>
  <?php if(isset($_COOKIE["prdupd"])):?>
    <p class="alert alert-info">La informacion del producto se ha actualizado exitosamente.</p>
  <?php setcookie("prdupd","",time()-18600); endif; ?>
	<br>
<div class="box box-primary">
  <table class="table">
  <tr>
  <td>
		<form class="form-horizontal" method="post" id="addproduct" enctype="multipart/form-data" action="index.php?view=updateproduct" role="form">
    <div class="row">
<div class="form-group col-lg-6">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
    <div class="col-md-10">
      <input type="text" name="name" value="<?php echo $product->name;?>" required class="form-control" id="name" placeholder="Nombre del Producto">
    </div>
  </div>
  
  <div class="form-group col-lg-6">
    <label for="inputEmail1" class="col-lg-2 control-label">Codigo de Barras*</label>
    <div class="col-md-4">
      <input type="text" value="<?php echo $product->barcode;?>" style='font-size:30px;font-weight:bolder;text-align: center;background-color: #ecf0f5;' name="barcode" id="product_code" class="form-control" id="barcode" placeholder="Codigo de Barras del Producto">
    </div>
  </div>
  
  <div class="form-group col-lg-6" >
    <label for="inputEmail1" class="col-lg-2 control-label">Categoria</label>
    <div class="col-md-10">
    <select name="category_id" class="form-control">
    <option value="">-- NINGUNA --</option>
    <?php foreach($categories as $category):
      if ($product->category_id=$category->id) {?>
      <option value="<?php echo $category->id;?>" selected><?php echo $category->name;?></option>
    <?php }else{ ?>
       <option value="<?php echo $category->id;?>"><?php echo $category->name;?></option>
      <?php } endforeach;?>
      </select>    </div>
  </div>
  <div class="form-group col-lg-6">
    <label for="inputEmail1" class="col-lg-2 control-label">Imagen</label>
    <div class="col-md-10">
      <input type="file" name="image" id="image" placeholder="">
    </div>
  </div>
  

  
  <div class="form-group col-lg-12">
    <label for="inputEmail1" class="col-lg-1 control-label">Descripcion</label>
    <div class="col-md-10">
      <textarea rows="8" value="" name="description" class="form-control" id="description" placeholder="Descripcion del Producto"><?php echo $product->description;?></textarea>
    </div>
  </div>
  <div class="form-group col-lg-6">
    <label for="inputEmail1" class="col-lg-2 control-label">Precio*</label>
    <div class="col-md-10">
      <input type="text" value="<?php echo $product->price_in;?>" name="price_in" required class="form-control" id="price_in" placeholder="Precio de compra">
    </div>
  </div>
  <div class="form-group col-lg-6">
    <label for="inputEmail1" class="col-lg-2 control-label">Estado*</label>
    <div class="col-md-10">
      <input type="text" name="state" required class="form-control" id="state" placeholder="Estado del Equipo/Producto">
    </div>
  </div>
  <div class="form-group col-lg-6">
    <label for="inputEmail1" class="col-lg-2 control-label">Fondos*</label>
    <div class="col-md-10">
      <input type="text" name="fund" required class="form-control" id="fund" placeholder="Fondos utilizados">
    </div>
  </div>
  <div class="form-group col-lg-6" >
    <label for="inputEmail1" class="col-lg-2 control-label">Almacen</label>
    <div class="col-md-10">
    <select name="category_id" class="form-control">
    <option value="">-- NINGUNA --</option>
    <?php foreach($categories as $category):?>
      <option value="<?php echo $category->id;?>"><?php echo $category->name;?></option>
    <?php endforeach;?>
      </select>    </div>
  </div>
  <div class="form-group col-lg-6">
    <label for="inputEmail1" class=" col-lg-2 control-label">Fecha Vencimiento/Caducidad</label>
    <div class=" col-lg-8" style="float:right;background-color:#ecf0f5;    padding: 10px;">
    <input class='' type="radio" value="2" name="habilitarDeshabilitar_date_venc" onchange="habilitar(this.value);" checked> NO tiene fecha de Vencimiento/Caducidad <br>
		<input class='form' type="radio" value="1" name="habilitarDeshabilitar_date_venc" onchange="habilitar(this.value);" > SI tiene fecha de Vencimiento/Caducidad 
	<div>
  <label  class=" col-lg-8 control-label">Fecha de vencimiento</label>
    <input type="date" name="date_venc" id="date_venc" class='form-control'>
    
	</div>
    </div>
  </div>
  <div class="form-group col-lg-6">
    <label for="inputEmail1" class=" col-lg-2 control-label">Garantia</label>
    <div class=" col-lg-8" style="float:right;background-color:#ecf0f5;    padding: 10px;">
    <input class='' type="radio" value="2" name="habilitarDeshabilitar_date_warr" onchange="habilitar(this.value);" checked> NO tiene Garantia<br>
		<input class='form' type="radio" value="1" name="habilitarDeshabilitar_date_warr" onchange="habilitar(this.value);" > SI tiene Garantia 
	<div>
  <label  class=" col-lg-10 control-label">Fecha de finalizacion de Garantia</label>
    <input type="date" name="date_warr" id="date_warr" class='form-control'>
    
	</div>
    </div>
  </div>
 

  <div class="form-group col-lg-6">
    <label for="inputEmail1" class=" col-lg-4 control-label">Minima en Inventario</label>
    <div class=" col-lg-8" style="float:right;background-color:#ecf0f5;padding: 10px;">
    <input class='' type="radio" value="2" name="habilitarDeshabilitar_min_inv" onchange="habilitar(this.value);" checked> Es producto unico<br>
    <input class='form' type="radio" value="1" name="habilitarDeshabilitar_min_inv" onchange="habilitar(this.value);" > No es Unico 
	<div>
    <input type="text" name="min_inv" id="min_inv" class='form-control' placeholder="Minimo de Equipo/Producto antes mostrar alerta">
    
	</div>
    </div>
  </div>

  <div class="form-group col-lg-6">
    <label for="inputEmail1" class="col-lg-2 control-label">Inventario inicial:</label>
    <div class="col-md-10">
      <input type="text" name="num_inv" class="form-control" id="num_inv" placeholder="Numero de Equipo/Producto Inicial">
    </div>
  </div>

  <div class="form-group">
    <div class="col-lg-offset-3 col-lg-8">
    <input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
      <button type="submit" class="btn btn-success">Actualizar Producto</button>
    </div>
  </div>
  </div> <!--row -->


</form>
</td>
</tr>
</table>
</div>
	</div>
</div>
<?php endif; ?>
</section>