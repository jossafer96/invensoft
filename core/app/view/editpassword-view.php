<section class="content">
<?php 
$password = PasswordData::getById($_GET["id"]);
$types = AccountTypeData::getAll();
$products = ProductData::getAll();
?>
<div class="row">
	<div class="col-md-12">
	<h1>Editar Contraseña</h1>
	<br>
  <div class="box box-primary">
  <table class="table">
  <tr><td>
		<form class="form-horizontal" method="post" id="addproduct" action="index.php?view=updatepassword" role="form">


  <div class="form-group">
  <label for="inputEmail1" class="col-lg-2 control-label">Tipo de cuenta*</label>
    <div class="col-md-10">
    <select  name="type_id" id="type_id" class="form-control" style="width: 40%;">
    <option value="">-- NINGUNA --</option>
    <?php foreach($types as $type):
      if ($password->id_type==$type->id) {?>
      <option value="<?php echo $type->id;?>" selected><?php echo $type->name;?></option>
    <?php }else{ ?>
      <option value="<?php echo $type->id;?>"><?php echo $type->name;?></option>
    <?php } endforeach;?>
      
      </select>  
      
    </div>
    <br>
    <br>
    <label for="inputEmail1" class="col-lg-2 control-label">Descripcion*</label>
    <div class="col-md-10">
      <input type="text" value="<?php echo $password->description;?>" style="width: 40%;" name="account" required class="form-control" id="account" placeholder="Nombre de la cuenta">
      
    </div>
    <br>
    <br>
    <label for="inputEmail1" class="col-lg-2 control-label">Contraseña*</label>
    <div class="col-md-10">
      <input type="password" value="<?php echo $password->password;?>" style="width: 35%;float: left;" name="password" required class="form-control" id="password<?php echo $password->id?>" placeholder="Escribir contraseña">
      
					<a style="padding: 7px;margin-left: 1.5rem;" id="check<?php echo $password->id?>"  class="btn btn-success btn-xs" onClick="isChecked(<?php echo $password->id?>);">Ver</a>   
					
    </div>
    <br>
    <br>
    <label for="inputEmail1" class="col-lg-2 control-label">Aplicar a*</label>
    <div class="col-md-10 select-search" >
    <input class="ss_input form-control" type="text" data-select-search="product_id" >
    <select  name="product_id" id="product_id" class="form-control" >
    <option value="">-- Elige el equipo --</option>
    <?php foreach($products as $product):
      if ($password->product_id==$product->id) {?>
      <option value="<?php echo $product->id;?>" selected><?php echo $product->barcode;?></option>
    <?php }else{ ?>
      <option value="<?php echo $product->id;?>"><?php echo $product->barcode;?></option>
    <?php } endforeach;?>
      </select>  
      
    </div>
    <br>
    <br>
    
  </div>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
    <input type="hidden" name="id" value="<?php echo $password->id;?>">
      <button type="submit" class="btn btn-primary">Actualizar Categoria</button>
    </div>
  </div>
</form>
</td>
</tr>
</table>
</div>
	</div>
</div>
</section>
<script>
			function isChecked (id) {
	if(document.getElementById('password'+id).type == 'password'){
    document.getElementById('password'+id).type = 'text';
  }
  else{
    document.getElementById('password'+id).type = 'password';
  }
}
		</script>