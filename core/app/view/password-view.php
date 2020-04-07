<link href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/css/uikit.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.uikit.min.css" rel="stylesheet" type="text/css" />
		<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Cuentas/Contraseñas
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">

<div class="row">
	<div class="col-md-12">
<div class="btn-group pull-right">
	<a href="index.php?view=newpassword" class="btn btn-default"><i class='fa fa-th-list'></i> Agregar nueva Cuenta/Contraseña</a>
</div>
<div class="clearfix"></div>
<br>
		<?php

		$users = PasswordData::getAll();
		if(count($users)>0){
			// si hay usuarios
			?>
<div class="box">
  <div class="box-header">
    

  </div><!-- /.box-header -->
  <div class="box-body">

			<table class="table table-bordered datatable table-hover">
			<thead>
		
			<th style="text-align: center; width: 45px;">Codigo</th>
			<th style="text-align: center; width: 100px;">Tipo</th>
			<th style="text-align: center; width: 250px;">Descripcion</th>
			<th style="text-align: center; width: 300px;">Contraseña</th>
			<th style="text-align: center; width: 80px;">Aplicada en</th>
			<th style="text-align: center;">Acciones</th>
			</thead>
			<?php
			foreach($users as $user){
				?>
				<tr>
				 
				</td>
				<td style="text-align: center;"><?php echo $user->id?></td>
				<td style="text-align: center;"><?php echo $user->type ?></td>
				<td><?php echo $user->description ?></td>
				<td style="text-align: center;">
					<input style="width: auto;" value="<?php echo $user->password ?>" type="password" name="" id="password<?php echo $user->id?>"> 
					<span class="checkbox" style="display: contents;">
					<a id="check<?php echo $user->id?>"  class="btn btn-success btn-xs" onClick="isChecked(<?php echo $user->id?>);">Ver</a>   
					</span>
				</td>
				<td style="text-align: center;"><?php echo $user->barcode ?></td>
				<td style="width:130px; text-align: center;"><a href="index.php?view=editpassword&id=<?php echo $user->id?>" class="btn btn-warning btn-xs">Editar</a> <a href="index.php?view=delpassword&id=<?php echo $user->unit_id;?>" class="btn btn-danger btn-xs">Eliminar</a></td>
				</tr>
				<?php

			}

?>
			</table>
  </div><!-- /.box-body -->
</div><!-- /.box -->
			
			<?php


		}else{
			echo "<p class='alert alert-danger'>No hay Categorias</p>";
		}


		?>


	</div>
</div>
		</section><!-- /.content -->
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