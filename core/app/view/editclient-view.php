<section class="content">
<?php $user = PersonData::getById($_GET["id"]);
$units = unitsData::getAll();
?>
<div class="row">
	<div class="col-md-12">
	<h1>Editar Colaborador/Empleado</h1>
	<br>
		<form class="form-horizontal" method="post" id="addproduct" action="index.php?view=updateclient" role="form">

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">N° Identidad*</label>
    <div class="col-md-6">
      <input type="text" name="no" value="<?php echo $user->no;?>" class="form-control" id="no" placeholder="0000-0000-00000">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
    <div class="col-md-6">
      <input type="text" name="name" value="<?php echo $user->name;?>" class="form-control" id="name" placeholder="Nombre">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Apellido*</label>
    <div class="col-md-6">
      <input type="text" name="lastname" value="<?php echo $user->lastname;?>" required class="form-control" id="lastname" placeholder="Apellido">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Direccion*</label>
    <div class="col-md-6">
      <input type="text" name="address1" value="<?php echo $user->address1;?>" class="form-control" id="username" placeholder="Direccion">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Email*</label>
    <div class="col-md-6">
      <input type="text" name="email1" value="<?php echo $user->email1;?>" class="form-control" id="email" placeholder="Email">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Telefono</label>
    <div class="col-md-6">
      <input type="text" name="phone1"  value="<?php echo $user->phone1;?>"  class="form-control" id="inputEmail1" placeholder="Telefono">
    </div>
  </div>

  <div class="form-group " >
    <label for="inputEmail1" class="col-lg-2 control-label">Unidad/Programa</label>
    <div class="col-md-6">
    <select name="program" class="form-control">
    <option value="">-- SELECCIONE UNO --</option>
    <?php foreach($units as $unit):
     if ($user->program==$unit->unit_id) {?>
      <option value="<?php echo $unit->unit_id;?>" selected><?php echo $unit->name_unit;?></option>
    <?php }else{ ?>
      <option value="<?php echo $unit->unit_id;?>"><?php echo $unit->name_unit;?></option>
    <?php } endforeach;?>
      </select>    
      </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Cargo</label>
    <div class="col-md-6">
      <input type="text" name="position" class="form-control" id="position" value="<?php echo $user->position;?>" placeholder="Cargo que tiene">
    </div>
  </div>

<!--  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label" >Activar Credito</label>
    <div class="col-md-6">
<div class="checkbox">
    <label>
      <input type="checkbox" name="has_credit" >
    </label>
  </div>
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Credito</label>
    <div class="col-md-6">
      <input type="text" name="credit_limit"    class="form-control" id="inputEmail1" placeholder="Credito">
    </div>
  </div>-->


  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label" >Activar Acceso</label>
    <div class="col-md-6">
<div class="checkbox">
    <label>
      <input type="checkbox" name="is_active_access" <?php if($user->is_active_access){ echo "checked";}?>>
    </label>
  </div>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Password</label>
    <div class="col-md-6">
      <input type="password" name="password" class="form-control" id="phone1" placeholder="Password">
    </div>
    </div>


  <p class="alert alert-danger">* Campos obligatorios</p>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
    <input type="hidden" name="user_id" value="<?php echo $user->id;?>">
      <button type="submit" class="btn btn-success">Actualizar Colaborador/Empleado</button>
    </div>
  </div>
</form>
	</div>
</div>
</section>