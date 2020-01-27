<section class="content">
<div class="row">
	<div class="col-md-12">
	<h1>Nueva Categoria</h1>
	<br>
  <div class="box box-primary">
  <table class="table">
  <tr><td>
		<form class="form-horizontal" method="post" id="addcategory" action="index.php?view=addcategory" role="form">
  <div class="form-group">
  
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
    <div class="col-md-10">
      <input type="text" style="width: 40%;" name="name" required class="form-control" id="name" placeholder="Nombre">
      
    </div>
    <br>
    <br>
    <label for="inputEmail1" class="col-lg-2 control-label">Abreviacion*</label>
    <div class="col-md-10">
      
      <input type="text" style="width: 40%;" name="abreviation" required class="form-control" id="abreviation" placeholder="Abreviacion">
    </div>
  </div>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-primary">Agregar Categoria</button>
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