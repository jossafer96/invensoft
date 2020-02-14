<section class="content">
<?php 
      $subcategory = SubCategoryData::getByIds($_GET["id"],$_GET["id2"]);
      $categories = CategoryData::getAll();
?>
<div class="row">
	<div class="col-md-12">
	<h1>Editar SubCategoria</h1>
	<br>
  <div class="box box-primary">
  <table class="table">
  <tr><td>
		<form class="form-horizontal" method="post" id="addproduct" action="index.php?view=updatesubcategory" role="form">


  <div class="form-group">
  <label for="inputEmail1" class="col-lg-2 control-label">Codigo*</label>
    <div class="col-md-10">
      <input type="text" value="<?php echo $subcategory->id;?>" style="width: 40%;" name="id" required class="form-control" id="id" placeholder="Asignar codigo">
      
    </div>
    <br>
    <br>
  <label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
    <div class="col-md-10">
      <input type="text" value="<?php echo $subcategory->name;?>" style="width: 40%;" name="name" required class="form-control" id="name" placeholder="Nombre">
      
    </div>
    <br>
    <br>
    <label for="inputEmail1" class="col-lg-2 control-label">Categoria*</label>
    <div class="col-md-10">
    <select name="category_id" id="category_id" class="form-control" style="width: 40%;">
    <option value="">-- NINGUNA --</option>
    <?php foreach($categories as $category):
      if ($subcategory->id_category==$category->id) {?>
      <option value="<?php echo $category->id;?>" selected><?php echo $category->name;?></option>
    <?php }else{ ?>
       <option value="<?php echo $category->id;?>"><?php echo $category->name;?></option>
      <?php } endforeach;?>
      </select> 
    </div>
    <br>
    <br>
    <label for="inputEmail1" class="col-lg-2 control-label">Descripcion</label>
    <div class="col-md-10">
      
      <input type="text" value="<?php echo $subcategory->description;?>" style="width: 40%;" name="description"  class="form-control" id="description" placeholder="Abreviacion">
    </div>
  </div>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
    <input type="hidden" name="user_id" value="<?php echo $subcategory->id;?>">
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