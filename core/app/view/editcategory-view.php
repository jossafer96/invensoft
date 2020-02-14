<section class="content">
<?php $user = CategoryData::getById($_GET["id"]);?>
<div class="row">
	<div class="col-md-12">
	<h1>Editar Categoria</h1>
	<br>
  <div class="box box-primary">
  <table class="table">
  <tr><td>
		<form class="form-horizontal" method="post" id="addproduct" action="index.php?view=updatecategory" role="form">


  <div class="form-group">
  <label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
    <div class="col-md-10">
      <input type="text" value="<?php echo $user->name;?>" style="width: 40%;" name="name" required class="form-control" id="name" placeholder="Nombre">
      
    </div>
    <br>
    <br>
    <label for="inputEmail1" class="col-lg-2 control-label">Abreviacion*</label>
    <div class="col-md-10">
      
      <input type="text" value="<?php echo $user->abreviation;?>" style="width: 40%;" name="abreviation" required class="form-control" id="abreviation" placeholder="Abreviacion">
    </div>
    <br>
    <br>
    <label for="inputEmail1" class="col-lg-2 control-label">Descripcion</label>
    <div class="col-md-10">
      
      <input type="text" value="<?php echo $user->description;?>" style="width: 40%;" name="description"  class="form-control" id="description" placeholder="Abreviacion">
    </div>
  </div>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
    <input type="hidden" name="user_id" value="<?php echo $user->id;?>">
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