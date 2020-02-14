<section class="content">
<?php 
$categories = CategoryData::getAll();

    ?>
<div class="row">
	<div class="col-md-12">
	<h1>Nueva SubCategoria</h1>
	<br>
  <div class="box box-primary">
  <table class="table">
  <tr><td>
		<form class="form-horizontal" method="post" id="addcategory" action="index.php?view=addsubcategory" role="form">
  <div class="form-group">

  <label for="inputEmail1" class="col-lg-2 control-label">Codigo*</label>
    <div class="col-md-10">
      <input type="text" style="width: 40%;" name="id" required class="form-control" id="id" placeholder="Asignar Codigo">
      
    </div>
    <br>
    <br>

    <label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
    <div class="col-md-10">
      <input type="text" style="width: 40%;" name="name" required class="form-control" id="name" placeholder="Nombre">
      
    </div>
    <br>
    <br>
    <label for="inputEmail1" class="col-lg-2 control-label">Categoria*</label>
    <div class="col-md-10">
      
    <select  name="category_id" id="category_id" style="width: 40%;" class="form-control" required onchange="codenext(this.value)">
    <option value="">-- Seleccione Una --</option>
    <?php foreach($categories as $category):?>
      <option value="<?php echo $category->id;?>"><?php echo $category->name;?></option>
    <?php endforeach;?>
      </select>
    </div>
    <br>
    <br>
    <label for="inputEmail1" class="col-lg-2 control-label">Descripcion</label>
    <div class="col-md-10">
      
      <input type="text" style="width: 40%;" name="description" required class="form-control" id="description" placeholder=" Breve descripcion">
    </div>
  </div>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-primary">Agregar Categoria</button>
    </div>
  </div>
  <strong>* Obligatorio</strong>
</form>
</td>
</tr>
</table>
</div>
	</div>
</div>
</section>